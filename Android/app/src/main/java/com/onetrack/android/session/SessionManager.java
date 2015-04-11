package com.onetrack.android.session;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;

import com.onetrack.android.OneTrackApplication;
import com.onetrack.android.Utils.Constants;

/**
 * Created by samsung on 05-04-2015.
 */
public class SessionManager {
    /*private Context mContext;
    SessionManager(Context context) {
        context = this;
    }*/

    public static boolean isLoggedIn() {
        SharedPreferences sharedPreferences = OneTrackApplication.getContext().
                getSharedPreferences(Constants.SESSION_PREFS, Context.MODE_PRIVATE);
        if (sharedPreferences.contains(Constants.USER_NAME_PREF)) {
            if(sharedPreferences.contains(Constants.USER_PWD_PREF)){
                return true;
            }
        }
        return false;
    }

    public static void createSession(String name, String pwd) {
        SharedPreferences sharedPreferences = OneTrackApplication.getContext().
                getSharedPreferences(Constants.SESSION_PREFS, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(Constants.USER_NAME_PREF, name);
        editor.putString(Constants.USER_PWD_PREF, pwd);
        editor.commit();
    }

    public static void destroySession() {
        SharedPreferences sharedPreferences = OneTrackApplication.getContext().
                getSharedPreferences(Constants.SESSION_PREFS, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.commit();
    }
}
