package dev.lab.foodieFinds;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Foodtruck {


        @SerializedName("id")
        @Expose
        String id;

        @SerializedName("operator_name")
        @Expose
        String operator_name;

        @SerializedName("foodtruck_name")
        @Expose
        String foodtruck_name;

        @SerializedName("schedule")
        @Expose
        String schedule;

        @SerializedName("menu_items")
        @Expose
        String menu_items;

        @SerializedName("latitude")
        @Expose
        String latitude;

        @SerializedName("longitude")
        @Expose
        String longitude;

    }

