package dev.lab.foodieFinds;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.fragment.app.DialogFragment;

public class FullDetailsDialogFragment extends DialogFragment {

    public FullDetailsDialogFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.dialog_full_details, container, false);

        // Retrieve arguments
        Bundle args = getArguments();
        String foodtruckName = args.getString("foodtruck_name");
        String details = args.getString("details");

        // Set data to views
        TextView tvFoodtruckName = view.findViewById(R.id.tv_foodtruck_name);
        TextView tvDetails = view.findViewById(R.id.tv_schedule);

        tvFoodtruckName.setText(foodtruckName);
        tvDetails.setText(details);

        return view;
    }
}
