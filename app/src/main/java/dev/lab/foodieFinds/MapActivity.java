package dev.lab.foodieFinds;

import android.Manifest;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ZoomControls;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.gson.Gson;

import java.util.Vector;

public class MapActivity extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private Vector<MarkerOptions> markerOptions;
    private ZoomControls zoomControls;
    private String URL = "http://foodiesfinds.atwebpages.com/all.php";
    private Gson gson;
    private Foodtruck[] foodtrucks;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle("Map View");

        gson = new Gson();

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map);
        if (mapFragment != null) {
            mapFragment.getMapAsync(this);
        }

        markerOptions = new Vector<>();

        zoomControls = findViewById(R.id.zoomControls);
        zoomControls.setOnZoomInClickListener(v -> mMap.animateCamera(CameraUpdateFactory.zoomIn()));
        zoomControls.setOnZoomOutClickListener(v -> mMap.animateCamera(CameraUpdateFactory.zoomOut()));
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        LatLng dahlia3 = new LatLng(6.45119, 100.28457);
        MarkerOptions dahlia3Marker = new MarkerOptions()
                .position(dahlia3)
                .title("My Location")
                .snippet("Dahlia 3, UiTM Arau")
                .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED));
        mMap.addMarker(dahlia3Marker);

        enableMyLocation();

        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(dahlia3, 18));

        sendRequest();

        mMap.setInfoWindowAdapter(new CustomInfoWindowAdapter());
        mMap.setOnInfoWindowClickListener(this::showFullDetails);
    }

    private void enableMyLocation() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
            if (mMap != null) {
                mMap.setMyLocationEnabled(true);
            }
        } else {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, 200);
        }
    }

    private void sendRequest() {
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        StringRequest stringRequest = new StringRequest(Request.Method.GET, URL, this::handleResponse, this::handleError);
        requestQueue.add(stringRequest);
    }

    private void handleResponse(String response) {
        Log.d("Foodtruck", "Response: " + response);
        foodtrucks = gson.fromJson(response, Foodtruck[].class);
        Log.d("Foodtruck", "Number of Foodtruck Data Points: " + foodtrucks.length);

        if (foodtrucks.length < 1) {
            Toast.makeText(getApplicationContext(), "Problem retrieving JSON data", Toast.LENGTH_LONG).show();
        }

        for (Foodtruck info : foodtrucks) {
            Log.d("Foodtruck Info", "Name: " + info.foodtruck_name + ", Schedule: " + info.schedule + ", Lat: " + info.latitude + ", Lng: " + info.longitude);

            Double lat = Double.parseDouble(info.latitude);
            Double lng = Double.parseDouble(info.longitude);
            String title = info.foodtruck_name;
            String snippet = "Operator: " + info.operator_name + "\nSchedule: " + info.schedule + "\nMenu: " + info.menu_items;

            MarkerOptions marker = new MarkerOptions().position(new LatLng(lat, lng))
                    .title(title)
                    .snippet(snippet)
                    .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_GREEN));

            markerOptions.add(marker);
            mMap.addMarker(marker);
        }
    }

    private void handleError(VolleyError error) {
        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_LONG).show();
    }

    private class CustomInfoWindowAdapter implements GoogleMap.InfoWindowAdapter {
        private final View mWindow;

        CustomInfoWindowAdapter() {
            mWindow = LayoutInflater.from(MapActivity.this).inflate(R.layout.custom_info_window, null);
        }

        @Override
        public View getInfoWindow(Marker marker) {
            render(marker, mWindow);
            return mWindow;
        }

        @Override
        public View getInfoContents(Marker marker) {
            render(marker, mWindow);
            return mWindow;
        }

        private void render(Marker marker, View view) {
            String title = marker.getTitle();
            TextView tvTitle = view.findViewById(R.id.title);
            tvTitle.setText(title != null ? title : "No Title");

            String snippet = marker.getSnippet();
            TextView tvSnippet = view.findViewById(R.id.snippet);
            tvSnippet.setText(snippet != null ? snippet : "No Details");

            Button btnShowMore = view.findViewById(R.id.btn_show_more);
            btnShowMore.setOnClickListener(v -> showFullDetails(marker));
        }
    }

    private void showFullDetails(Marker marker) {
        FullDetailsDialogFragment dialog = new FullDetailsDialogFragment();
        Bundle args = new Bundle();
        args.putString("foodtruck_name", marker.getTitle());
        args.putString("details", marker.getSnippet());
        dialog.setArguments(args);
        dialog.show(getSupportFragmentManager(), "full_details");
    }

    @Override
    public boolean onSupportNavigateUp() {
        onBackPressed();
        return true;
    }
}
