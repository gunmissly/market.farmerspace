<style>
    ul li a i span{
        padding-left: 10px;
        font-family: 'Prompt';
        font-weight: 300;
        font-size: 16px;
        vertical-align: middle;

    }
    a{
         color: #9DA0A7;
    }
    .fa-2x{
        font-size: 1.6em!important;
    }

</style>
<style>
     @media screen and (min-width: 48em) {
          .menubar{
            margin-left: 15px;
          }
    }
</style>
<!--slider menu-->
<div class="sidebar-menu" style="position: fixed;">
    <div style="padding: 0.7em 0em;background-color: #22272A;box-shadow: 0 1px 3px rgba(0,0,0,0.15);">
        <ul id="menu" style="margin:10px 0;">
            <li>
                <a href="{{ url('/') }}" style="padding: 8px 20px;">
                    <img alt="Logo" class="img img-responsive center-block" id="logopic" src="{{ URL::asset('/market/images/LogoHeader_Admin.png') }}"/>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu" style="font-weight: 300;">

    <!-- User Menu -->
        <ul id="menu" style="margin:8px 0;">
            <li id="market-text">
                <a class="menubar" href="{{ url('/') }}" style="text-align: left!important;">
                    <i class="fa fa-truck fa-2x" aria-hidden="true" style="margin-bottom: 0px;">
                        <span>
                        Market
                        </span>
                    </i>
                </a>
            </li>
        </ul>
    <!-- End User Menu -->

        <!-- General Menu -->
        <ul id="menu" style="margin:40px 0 8px 0;">
            <li id="my-account-text">
                <a class="menubar" href="{{ url('/profile') }}" style="text-align: left!important;">
                    <i class="fa fa-cog fa-2x" aria-hidden="true" style="margin-bottom: 0px;">
                        <span>
                            My Account
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin-bottom: 0px;">
            <li>
                <a class="menubar" href="{{ url('/logout') }}" style="text-align: left!important;">
                    <i aria-hidden="true" class="fa fa-power-off fa-2x">
                        <span>
                            Logout
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <!-- End General Menu -->

    </div>
</div>
<div class="clearfix">
</div>

