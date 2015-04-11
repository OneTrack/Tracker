package com.onetrack.android;

import android.app.Application;
import android.content.Context;

/**
 * Created by samsung on 10-04-2015.
 */
public class OneTrackApplication extends Application {
    private static Context mContext;

    @Override
    public void onCreate() {
        super.onCreate();
        mContext = this;
    }

    public static Context getContext() {
        return mContext;
    }
}
