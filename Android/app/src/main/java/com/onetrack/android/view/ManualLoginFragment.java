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

/**
 * Created by samsung on 03-04-2015.
 */
public class ManualLoginFragment extends Fragment {

    private class UserLoginTask extends AsyncTask<Void,Void,Boolean> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Boolean doInBackground(Void... params) {
            return null;
        }
    }

    private Button loginButton;
    private AutoCompleteTextView emailTv;
    private EditText pwdTv;
    private Context mContext;

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
                String email = emailTv.getText().toString().trim();
                String pwd = pwdTv.getText().toString();
                if(Utils.isNotNull(email) && Utils.isNotNull(pwd)) {
                    if (!Utils.validateEmail(email)) {
                        Toast.makeText(mContext, "Email is not valid!", Toast.LENGTH_SHORT).show();
                        return;
                    }
                    /*if(!pwd.equals(cnfPwd)) {
                        Toast.makeText(mContext, "Passwords do not match!", Toast.LENGTH_SHORT).show();
                        return;
                    }*/
                    Account.login(mContext, email, pwd);
                } else {
                    Toast.makeText(mContext, "All fields are mandatory!", Toast.LENGTH_SHORT).show();
                }
            }
        });
        return root;
    }
}
