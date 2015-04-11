package com.onetrack.android.view;

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

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by samsung on 04-04-2015.
 */
public class ManualSignupFragment extends Fragment {

    private class UserSignupTask extends AsyncTask<Void,Void,Boolean> {

        private String name, email, pwd, cnfPwd;

        UserSignupTask(String name, String email, String pwd, String cnfPwd) {
            this.name = name;
            this.email = email;
            this.pwd = pwd;
            this.cnfPwd = cnfPwd;
        }
        @Override
        protected Boolean doInBackground(Void... params) {
            String response = Account.signUp(name,email,pwd,cnfPwd);
            if(null == response)
                return false;
            try {
                JSONObject responseJson = new JSONObject(response).getJSONObject("response");
                if(null == responseJson)
                    return false;
                Boolean status = responseJson.getBoolean("result");
                String msg = responseJson.getString("message");
                if (true == status) {
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

            } else {
                Toast.makeText(mContext,"Something went wrong!! TryAgain!",Toast.LENGTH_SHORT).show();
            }
            super.onPostExecute(result);
        }
    }
    private Button signupButton;
    private AutoCompleteTextView emailTv;
    private EditText nameTv, pwdTv, cnfPwdTv;
    private Context mContext;
    private UserSignupTask mUserSignupTask;

    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.manual_signup_fragment,container,false);
        mContext = getActivity();
        signupButton = (Button)root.findViewById(R.id.manual_sign_up_button);
        emailTv = (AutoCompleteTextView) root.findViewById(R.id.manual_signup_email);
        nameTv = (EditText) root.findViewById(R.id.manual_signup_name);
        pwdTv = (EditText) root.findViewById(R.id.manual_signup_password);
        cnfPwdTv = (EditText) root.findViewById(R.id.manual_signup_cnf_password);

        signupButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                attemptSignup();
            }
        });
        return root;
    }

    //TODO add error on all views
    private void attemptSignup() {
        String email = emailTv.getText().toString().trim();
        String name = nameTv.getText().toString().trim();
        String pwd = pwdTv.getText().toString();
        String cnfPwd = cnfPwdTv.getText().toString();
        if(Utils.isNotNull(email) && Utils.isNotNull(name) && Utils.isNotNull(pwd) &&Utils.isNotNull(cnfPwd)) {
            if (!Utils.validateEmail(email)) {
                Toast.makeText(mContext, "Email is not valid!", Toast.LENGTH_SHORT).show();
                return;
            }
            if(!pwd.equals(cnfPwd)) {
                Toast.makeText(mContext, "Passwords do not match!", Toast.LENGTH_SHORT).show();
                return;
            }
            mUserSignupTask = new UserSignupTask(name,email,pwd,cnfPwd);
            mUserSignupTask.execute(); //TODO executeOnexecutor if required

        } else {
            Toast.makeText(mContext, "All fields are mandatory!", Toast.LENGTH_SHORT).show();
        }
    }
}
