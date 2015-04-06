package com.onetrack.android.view;

import android.content.Context;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.onetrack.android.R;
import com.onetrack.android.Utils.Utils;
import com.onetrack.android.session.Account;

/**
 * Created by samsung on 04-04-2015.
 */
public class ManualSignupFragment extends Fragment {
    private Button signupButton;
    private AutoCompleteTextView emailTv;
    private EditText nameTv, pwdTv, cnfPwdTv;
    private Context mContext;

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
                    Account.signUp(name,email,pwd,cnfPwd);
                } else {
                    Toast.makeText(mContext, "All fields are mandatory!", Toast.LENGTH_SHORT).show();
                }
            }
        });
        return root;
    }
}
