package com.onetrack.android.session;

import android.util.Log;

import com.onetrack.android.Utils.Constants;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;


/**
 * Created by samsung on 05-04-2015.
 */
public class Account {

    //FIXME add try catch finally properly
    public static String login(String email,String pwd) {
        final String url = Constants.HOST_NAME +
                "user/login";
        try {
            URL obj = new URL(url);
            HttpURLConnection con = (HttpURLConnection) obj.openConnection();

            //add reuqest header
            con.setRequestMethod("POST");
            //con.setRequestProperty("User-Agent", USER_AGENT);
            //con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
            String urlParameters = "email="+email+"&password="+pwd;

            // Send post request
            con.setDoOutput(true);
            DataOutputStream wr = new DataOutputStream(con.getOutputStream());
            wr.writeBytes(urlParameters);
            wr.flush();
            wr.close();

            int responseCode = con.getResponseCode();
            System.out.println("\nSending 'POST' request to URL : " + url);
            System.out.println("Post parameters : " + urlParameters);
            System.out.println("Response Code : " + responseCode);

            BufferedReader in = new BufferedReader(
                    new InputStreamReader(con.getInputStream()));
            String inputLine;
            StringBuilder response = new StringBuilder();

            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
            //print result
            System.out.println(response.toString());
            return response.toString();
        }catch (Exception e) {
            e.printStackTrace();
            Log.d("Satyen","Exception in login");
            return null;
        }
    }

    public static String signUp(String userName, String email, String pwd, String cnfPwd){
        final String url = Constants.HOST_NAME + "user/registration";

        try {
            URL obj = new URL(url);
            HttpURLConnection con = (HttpURLConnection) obj.openConnection();

            //add reuqest header
            con.setRequestMethod("POST");
            //con.setRequestProperty("User-Agent", USER_AGENT);
            //con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
            String urlParameters = "name="+userName+"&email="+email+"&password="+pwd+"&confirm_password="+cnfPwd;

            // Send post request
            con.setDoOutput(true);
            DataOutputStream wr = new DataOutputStream(con.getOutputStream());
            wr.writeBytes(urlParameters);
            wr.flush();
            wr.close();

            int responseCode = con.getResponseCode();
            System.out.println("\nSending 'POST' request to URL : " + url);
            System.out.println("Post parameters : " + urlParameters);
            System.out.println("Response Code : " + responseCode);

            BufferedReader in = new BufferedReader(
                    new InputStreamReader(con.getInputStream()));
            String inputLine;
            StringBuilder response = new StringBuilder();

            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
            //print result
            System.out.println(response.toString());
            return response.toString();
        }catch (Exception e) {
            e.printStackTrace();
            Log.d("Satyen","Exception in signup");
        }
        return null;
    }

    public static void logOut() {
        SessionManager.destroySession();
    }

}

