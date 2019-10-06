<?php

namespace App\Http\Resources;

class EventTransformer
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function eventTransformer($events_json)
    {
        $new_keys = [];
        $array_new = false;
        $price = 0;
        $product_name = "";
        $store_name = "";
        $i_product = 0;
        $product = 0;
        foreach ($events_json["events"] as $key => $event) {
            foreach ($event["custom_data"] as $i => $value) {
                if ($value["key"] == "transaction_id") {
                    $new_key = $value["value"];
                    if (!in_array($new_key, $new_keys) && !empty($new_keys)) {
                        $array_new = true;
                    }

                    if (in_array($new_key, $new_keys)) {
                        $events_json["events"][$new_key]["store_name"] = $store_name;
                        $events_json["events"][$new_key]["revenue"] = $events_json["events"][$new_key]["revenue"] += $price;
                    } else {
                        $events_json["events"][$new_key] = $events_json["events"][$key];
                        $events_json["events"][$new_key] = [
                            "timestamp" => $events_json["events"][$new_key]["timestamp"],
                            "revenue" => 0,
                            "transaction_id" => $value["value"],
                            "store_name" => $store_name,
                            "products" => [
                                [
                                    "name" => $product_name,
                                    "price" => $price
                                ]
                            ]
                        ];
                        if ($array_new) {
                            $product = 0;
                            $i_product = 0;
                        }
                        if ($events_json["events"][$new_key]["products"][0]["name"] != "" || $events_json["events"][$new_key]["products"][0]["name"] != 0) {
                            $product++;
                        }
                        unset($events_json["events"][$key]);
                        $new_keys[] = $value["value"];
                    }
                }
                if ($value["key"] == "product_price") {
                    if ($array_new && !empty($new_key)) {
                        if ($product % 2 == 0 && $product != 0) {
                            $i_product++;
                        }
                        $events_json["events"][$new_key]["revenue"] = $events_json["events"][$new_key]["revenue"] + $value["value"];
                        $events_json["events"][$new_key]["products"][$i_product]["price"] =  $value["value"];
                        $price = 0;
                        $product++;
                    } else if (isset($new_key) && in_array($new_key, $new_keys)) {
                        if ($product % 2 == 0 && $product != 0) {
                            $i_product++;
                        }
                        $events_json["events"][$new_key]["revenue"] = $events_json["events"][$new_key]["revenue"] + $value["value"];
                        $events_json["events"][$new_key]["products"][$i_product]["price"] = $value["value"];
                        $price = 0;
                        $product++;
                    } else {
                        $price = $value["value"];
                    }
                }
                if ($value["key"] == "product_name") {

                    if ($array_new && !empty($new_key)) {
                        if ($product % 2 == 0 && $product != 0) {
                            $i_product++;
                        }

                        $events_json["events"][$new_key]["products"][$i_product]["name"] = $value["value"];
                        $product_name = "";
                        $product++;
                    } else if (isset($new_key) && in_array($new_key, $new_keys)) {
                        if ($product % 2 == 0 && $product != 0) {
                            $i_product++;
                        }
                        $events_json["events"][$new_key]["products"][$i_product]["name"] = $value["value"];
                        $product_name = "";
                        $product++;
                    } else {
                        $product_name = $value["value"];
                    }
                }
                if ($value["key"] == "store_name") {
                    if ($array_new) {
                        $events_json["events"][$new_key]["store_name"] = $value["value"];
                        $store_name = "";
                    } else {
                        $store_name = $value["value"];
                    }
                }
            }
            unset($events_json["events"][$key]);
        }
        return $events_json["events"];
    }
}
