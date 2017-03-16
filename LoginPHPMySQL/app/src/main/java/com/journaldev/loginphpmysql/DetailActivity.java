package com.journaldev.loginphpmysql;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class DetailActivity extends AppCompatActivity {

    TextView username, fullname, gender, age, address;

    String URL= "http://10.0.2.2/danhnv_android_test_1/index.php";

    JSONParser jsonParser=new JSONParser();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail);

        username=(TextView) findViewById(R.id.username);
        fullname=(TextView) findViewById(R.id.fullname);
        gender=(TextView) findViewById(R.id.gender);
        age=(TextView) findViewById(R.id.age);
        address=(TextView) findViewById(R.id.address);

        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            String value = extras.getString("USER_ID");

            AttemptGetData attemptLogin = new AttemptGetData();
            attemptLogin.execute(value);
        }
    }


    private class AttemptGetData extends AsyncTask<String, String, JSONObject> {

        @Override

        protected void onPreExecute() {

            super.onPreExecute();

        }

        @Override

        protected JSONObject doInBackground(String... args) {


            String userId= args[0];

            ArrayList<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("userId", userId));

            JSONObject json = jsonParser.makeHttpRequest(URL, "POST", params);


            return json;

        }

        protected void onPostExecute(JSONObject result) {

            // dismiss the dialog once product deleted
            //Toast.makeText(getApplicationContext(),result,Toast.LENGTH_LONG).show();

            try {
                if (result != null) {
                    fullname.setText(result.getString("fullname"));
                    gender.setText(result.getString("gender"));
                    age.setText(result.getString("age"));
                    address.setText(result.getString("address"));
                } else {
                    Toast.makeText(getApplicationContext(), "Unable to retrieve any data from server", Toast.LENGTH_LONG).show();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }


        }

    }
}
