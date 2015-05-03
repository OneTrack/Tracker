<div id="sidePanel">
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    <br>
    <div align="center"><img src="/assets/images/team/leena.JPG" style="width:110px;" class="img-circle"></div>
    <div align="center"><b> Welcome Leena !</b></div>
    <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a id="overview" onclick="loadRightContent(this,'/admin/overview');" aria-controls="overview" role="tab" data-toggle="tab">Overview</a></li>
    <li><a id="profiile" onclick="loadRightContent(this,'/admin/profile');" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li><a id="settings" onclick="loadRightContent(this,'/admin/settings');" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  	</ul>
    </div>
    <div role="tabpanel" class="tab-pane" id="products">
    <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a id="showproduct" onclick="loadRightContent(this,'/admin/showproduct');" aria-controls="showproduct" role="tab" data-toggle="tab">All Product</a></li>
    <li><a id="addproduct" onclick="loadRightContent(this,'/admin/addproduct');" aria-controls="addproduct" role="tab" data-toggle="tab">Add Product</a></li>
    <li><a href="#registerdProduct" aria-controls="registerdProduct" role="tab" data-toggle="tab">Registerd Product</a></li>
  	</ul>
    </div>
    <div role="tabpanel" class="tab-pane" id="plans">
    <ul class="nav nav-tabs nav-stacked">
    <li><a href="#addplans" aria-controls="addplans" role="tab" data-toggle="tab">Add Plans</a></li>
    <li><a href="#registerdPlans" aria-controls="registerdPlans" role="tab" data-toggle="tab">Registerd Plans</a></li>
  	</ul>
    </div>
    </div>
  </div>
</div>