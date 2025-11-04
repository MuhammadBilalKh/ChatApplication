<div class="modal fade login-modal" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner">
                    <img src="https://secure.gravatar.com/avatar/?s=96&#038;d=mm&#038;r=g" alt="Guest"
                        class="avatar guest-avatar">
                </div>
            </div>
            <div class="modal-body">
                <h4 class="modal-title">Log into your account</h4>
                <form action="{{ route('users.authenticate') }}" method="{{ FORM_METHOD_POST }}" id="modal-login-form"
                    class="kmk-login-form modal-login-form" name="modal-login-form">
                    @csrf
                    <div class="form-group">
                        <div class="user-name">
                            <label class="screen-reader-text">Email/username</label>
                            <span class="icon"><i class="uil-user"></i></span>
                            <input type="text" id="modal-username" class="username-control" required name="log"
                                value="" placeholder="Email or username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pass">
                            <label class="screen-reader-text">Password</label>
                            <span class="icon"><i class="uil-key-skeleton-alt"></i></span>
                            <input type="password" id="modal-password" class="password-control" required name="pwd"
                                value="" placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-options">
                        <div class="row">
                            <div class="col-6">
                                <div class="forgetmenot">
                                    <label for="modal-rememberme">
                                        <input id="modal-rememberme" name="rememberme" type="checkbox"
                                            value="forever" /> Remember Me </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="forgot-password">
                                    <a href="./my-account/lost-password/">
                                        Lost Password? </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kmk-login-result"></div>
                    <div class="submit">
                        <button type="submit" id="modal_login_submit" class="submit-login" name="wp-submit">Log Into
                            Your Account</button>
                    </div>
                    <input type="hidden" id="modal-login-security" name="modal-login-security"
                        value="f9716ba2fa" /><input type="hidden" name="_wp_http_referer"
                        value="/MIGVELv1/activity-2/" />
                    <div class="register-link">
                        <a href="./register/" class="register color-primary">Create an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="icon ion-close-round"></i>
    </button>
</div>
