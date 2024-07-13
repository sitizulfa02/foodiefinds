package dev.lab.foodieFinds;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Foodtruck {


        @SerializedName("id")
        @Expose
        String id;
        @SerializedName("name")
        @Expose
        String name;
        @SerializedName("description")
        @Expose
        String description;
        @SerializedName("lat")
        @Expose
        String lat;
        @SerializedName("lng")
        @Expose
        String lng;

    }

