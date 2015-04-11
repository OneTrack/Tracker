package com.onetrack.android.view;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.PagerAdapter;
import android.support.v4.view.ViewPager;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;

import com.onetrack.android.R;
import com.onetrack.android.session.Account;
import com.onetrack.android.session.SessionManager;
import com.onetrack.android.widgets.SlidingTabLayout;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by samsung on 06-04-2015.
 */
public class UserHomeActivity extends FragmentActivity{
    private ViewPager mViewPager;
    private SlidingTabLayout mSlidingTabLayout;
    private UserHomePagerAdapter mUserHomePagerAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.user_home_activity);
        mViewPager = (ViewPager) findViewById(R.id.user_home_view_pager);
        mSlidingTabLayout = (SlidingTabLayout) findViewById(R.id.user_home_sliding_tab_layout);

        List<UserHomeFragmentWrapper> list = new ArrayList<>();
        list.add(new UserHomeFragmentWrapper(new UserHomeProductsFragment(),"Products"));
        list.add(new UserHomeFragmentWrapper(new UserHomeProductsFragment(),"Expiry Calendar"));
        mUserHomePagerAdapter = new UserHomePagerAdapter(list,getSupportFragmentManager());
        mViewPager.setAdapter(mUserHomePagerAdapter);
        mSlidingTabLayout.setViewPager(mViewPager);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        menu.add("log out");
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(item.getTitle().equals("log out")) {
            Account.logOut();
            moveTaskToBack(true);
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    private class UserHomePagerAdapter extends FragmentPagerAdapter {

       List<UserHomeFragmentWrapper> mUserHomeFragmentWrapperList = new ArrayList<>();

        public UserHomePagerAdapter(List<UserHomeFragmentWrapper> list, FragmentManager fm) {
            super(fm);
            mUserHomeFragmentWrapperList = list;
        }

        @Override
        public int getCount() {
            return mUserHomeFragmentWrapperList.size();
        }

        @Override
        public CharSequence getPageTitle(int position) {
            return mUserHomeFragmentWrapperList.get(position).getTitle();
        }

        @Override
        public Fragment getItem(int position) {
            return mUserHomeFragmentWrapperList.get(position).getFragment();
        }

        /*@Override
        public void destroyItem(ViewGroup container, int position, Object object) {
            super.destroyItem(container, position, object);
        }*/
    }

    private class UserHomeFragmentWrapper {
        private Fragment mFragment;
        private String mTitle;

        public UserHomeFragmentWrapper(Fragment fragment, String title) {
            mFragment = fragment;
            mTitle  = title;
        }

        public Fragment getFragment() {
            return mFragment;
        }
         public String getTitle() {
             return mTitle;
         }
    }
}
