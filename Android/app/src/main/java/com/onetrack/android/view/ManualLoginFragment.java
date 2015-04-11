package com.onetrack.android.view;


import android.app.Activity;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.onetrack.android.R;
import com.onetrack.android.Utils.Utils;
import com.onetrack.android.session.Account;
import com.onetrack.android.session.SessionManager;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by samsung on 03-04-2015.
 */
public class ManualLoginFragment extends Fragment {

    public interface LoginAuthorizationListener{
        public void onUserAuthorised();
    }

    private class UserLoginTask extends AsyncTask<Void,Void,Boolean> {
        String email;
        String pwd;
        UserLoginTask(String email, String pwd) {
            this.email = email;
            this.pwd = pwd;
        }
        @Override
        protected void onPreExecute() {

            super.onPreExecute();
        }

        @Override
        protected Boolean doInBackground(Void... params) {
            String response = Account.login(email,pwd);
            if(null == response)
                return false;
            try {
                JSONObject responseJson = new JSONObject(response).getJSONObject("response");
                Boolean status = responseJson.getBoolean("result");
                String msg = responseJson.getString("message");
                if (status) {
                    System.out.println("logged in");
                    return true;
                }
            }catch (JSONException e) {
                e.printStackTrace();
            }
            return false;
        }

        @Override
        protected void onPostExecute(Boolean result) {
            if(result) {
                SessionManager.createSession(email,pwd);
                mListener.onUserAuthorised();
            }
            mLoginTask = null;
            super.onPostExecute(result);
        }
    }

    private Button loginButton;
    private AutoCompleteTextView emailTv;
    private EditText pwdTv;
    private Context mContext;
    private UserLoginTask mLoginTask;
    private LoginAuthorizationListener mListener;

    @Override
    public void onAttach(Activity activity) {
        mListener = (LoginAuthorizationListener)activity;
        super.onAttach(activity);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.manual_login_fragment,container,false);
        mContext = getActivity();
        loginButton = (Button)root.findViewById(R.id.manual_login_button);
        emailTv = (AutoCompleteTextView) root.findViewById(R.id.manual_login_email);
        pwdTv = (EditText) root.findViewById(R.id.manual_login_password);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                attemptLogin();
            }
        });
        return root;
    }

    //TODO seterror on all views when error is there. Refer UserLoginActivity
    private void attemptLogin() {
        String email = emailTv.getText().toString().trim();
        String pwd = pwdTv.getText().toString();
        if(Utils.isNotNull(email) && Utils.isNotNull(pwd)) {
            if (!Utils.validateEmail(email)) {
                Toast.makeText(mContext, "Email is not valid!", Toast.LENGTH_SHORT).show();
                return;
            }
            mLoginTask = new UserLoginTask(email,pwd);
            mLoginTask.execute(); //TODO replace with executor if required.
        } else {
            Toast.makeText(mContext, "All fields are mandatory!", Toast.LENGTH_SHORT).show();
        }
    }
}
