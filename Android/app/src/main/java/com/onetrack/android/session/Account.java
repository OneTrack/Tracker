package com.onetrack.android.session;

import android.content.Context;
import android.os.Looper;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;


/**
 * Created by samsung on 05-04-2015.
 */
public class Account {

    public static void login(final Context context,final String email,final String pwd) {
        final String url = "http://192.168.0.104/" +
                "index.php/user/login";

        new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    Looper.prepare();
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
                    StringBuffer response = new StringBuffer();

                    while ((inputLine = in.readLine()) != null) {
                        response.append(inputLine);
                    }
                    //print result
                    System.out.println(response.toString());
                    JSONObject responseJson = new JSONObject(response.toString()).getJSONObject("response");
                    Boolean status = responseJson.getBoolean("result");
                    String msg = responseJson.getString("message");
                    if(true == status) {
                        Toast.makeText(context, "Login Successful", Toast.LENGTH_SHORT).show();
                        System.out.println("logged in");
                    }
                }catch (Exception e) {
                    e.printStackTrace();
                    Log.d("Satyen","Exception in login");
                }
            }
        }).start();
    }

    public static void signUp(final String userName,final String email,final String pwd,final String cnfPwd){
        final String url = "http://192.168.0.104/index.php/user/registration";

        new Thread(new Runnable() {
            @Override
            public void run() {
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
                    StringBuffer response = new StringBuffer();

                    while ((inputLine = in.readLine()) != null) {
                        response.append(inputLine);
                    }
                    //print result
                    System.out.println(response.toString());
                }catch (Exception e) {
                    e.printStackTrace();
                    Log.d("Satyen","Exception in signup");
                }
            }
        }).start();



    }

}

