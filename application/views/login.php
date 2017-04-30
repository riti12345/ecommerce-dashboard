<style type="text/css">
 .login-icon{
    margin: 4.5px 10px 0px 0px;
  }
  
  .mdl-textfield {
    width: 100%;
  }
  
  .mdl-textfield__input {
    width: 90%;
    float: right;
  }

  .mdl-button.mdl-button--colored{
    color: #fff;
    background-color: rgb(0, 142, 60);
  }
</style>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100 login_img">
  <main class="mdl-layout__content" ng-controller="loginCtrl">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--4-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone" style="margin-left:auto ; margin-right:auto;margin-top: 130px;">
        <div class="mdl-card mdl-shadow--6dp" style="height: 300px;">
          <div class="mdl-card__title mdl-color-text--white center-block">
            <img src="assets/image/logo.png" style="margin-top:10px;">
            
          </div>

          <form id="loginForm">
          <div class="mdl-card__supporting-text" style="padding: 5px 16px;">
              <div class="">
                <div class="mdl-textfield mdl-js-textfield">
                  <i class="material-icons login-icon" id="clientIcon">account_circle</i>
                  <input class="mdl-textfield__input" id="email" type="email" placeholder="Email" ng-model="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
                  <span class="mdl-textfield__error">Invalid Email!</span>
                </div>
              </div>
              <div class="">
                <div class="mdl-textfield mdl-js-textfield">
                  <i class="material-icons login-icon" id="clientIcon">lock</i>
                  <input class="mdl-textfield__input" id="pass" type="password" placeholder="Password" ng-model="pass" />
                </div>
              </div>
          </div>
          <div class="mdl-card__actions ">
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_login center-block" ng-click="login()"
             style=" min-width: 143px;">Log in</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/login.js';?>"></script>