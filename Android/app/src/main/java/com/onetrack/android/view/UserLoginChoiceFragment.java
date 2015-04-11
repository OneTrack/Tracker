package com.onetrack.android.view;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.facebook.CallbackManager;
import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.login.LoginResult;
import com.facebook.login.widget.LoginButton;
import com.onetrack.android.R;

/**
 * Created by samsung on 01-04-2015.
 */
public class UserLoginChoiceFragment extends android.support.v4.app.Fragment implements View.OnClickListener{

    private Context mContext;
    private CallbackManager mCallbackManager;
    private LoginChoiceButtonClickListener mListener;

    public interface LoginChoiceButtonClickListener {
        public void onChoiceButtonClicked(int btnId);
    }

    @Override
    public void onAttach(Activity activity) {
        super.onAttach(activity);
        mListener = (LoginChoiceButtonClickListener)activity;
    }

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.login_choice_fragment, container,false);
        mContext = getActivity();
        LoginButton fbloginButton = (LoginButton)root.findViewById(R.id.fb_login_button);
        Button login = (Button)root.findViewById(R.id.login_button);
        Button signUp = (Button)root.findViewById(R.id.sign_up_button);
        fbloginButton.setFragment(UserLoginChoiceFragment.this);

        login.setOnClickListener(this);
        signUp.setOnClickListener(this);

        mCallbackManager = CallbackManager.Factory.create();
        fbloginButton.registerCallback(mCallbackManager, new FacebookCallback<LoginResult>() {
            @Override
            public void onSuccess(LoginResult loginResult) {
                Toast.makeText(mContext,"Login Successfull",Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onCancel() {

            }

            @Override
            public void onError(FacebookException e) {

            }
        });

        return root;
    }

    @Override
    public void onClick(View v) {
        mListener.onChoiceButtonClicked(v.getId());
       /* switch (v.getId()) {
            case R.id.login_button :
                mListener.onButtonClicked();
                break;
            case R.id.sign_up_button :
                break;
            default:
                break;
        }*/
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        mCallbackManager.onActivityResult(requestCode, resultCode, data);
    }
}
