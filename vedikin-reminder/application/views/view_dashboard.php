<style>
.box-body {
    height: 300px;
    overflow-y: scroll;
}

.menu-wrapper {
    background: white;
    padding: 30px 0px;
}
.menu-box {
    border: 2px solid #f38020;
    border-radius: 10px;
    text-align: center;
    margin-bottom: 20px;
    transition: 0.9s;
    opacity: 0.8;
    min-height:180px;
}
.menu-box:hover {
    box-shadow: 5px 5px 5px 5px #f38020;
    transition: 0.9s;
    opacity: 1.0;
    background-color:#3e3e3f;
}
.menu-box:hover a .menu-name{
    color:#fff;
}
@media (max-width: 767px){
    .menu-box {
        height: 200px;
    }
}
div.menu-box .menu-icon {
    margin: 0 auto;
    padding: 10px;
}

div.menu-box .menu-icon img {
    margin: 0 auto;
    max-width: 100%;
}
@media(max-width:1150px)
{
    div.menu-box .menu-icon img {
        margin: 0 auto;
        max-width: 100%;
        max-height: 140px;
    }
}
@media(max-width:900px)
{
    div.menu-box .menu-icon img {
    margin: 0 auto;
    max-width: 100%;
    max-height: 140px;
    }
}

.menu-name {
    font-weight: 600;
    font-size: 18px;
    color: #6d8391;
}

.menu-user{
    width:100px;height:100px;display:inline-block;background-position: 0px -0px;
}
.menu-box:hover .menu-user{
    width:100px;height:100px;display:inline-block;background-position: -100px -0px;
}

@media screen and (max-width: 1400px) and (min-width: 1200px) {
    .col-md-3 {
        width: 20%;
    }
}
@media(min-width: 1400px) {
    .col-md-3 {
        width: 16%;
    }
}
@media(min-width: 2000px) {
    .col-md-3 {
        width: 11%;
    }
}
</style>

<div class="row menu-wrapper">
    <div class='col-md-3 margin-top-bottom'>
        <div class="menu-box">
            <a href="<?php echo SITE_URL . "dashboard"; ?>">
                <div class="menu-icon">
                    <div class="menu-user" style="background-image: url(<?php echo MENU_ICON_PATH ."dashboard.png" ?>); "></div>
                </div>
                <span class="menu-name"><?php echo "Dashboard"; ?></span>
            </a>
        </div>
    </div>

    <?php 
    if($this->session->userdata['logged_in']['user_role_id'] == "1" || $this->session->userdata['logged_in']['user_role_id'] == "2") {
		foreach ($menus as $menu)  { ?>
            <div class='col-md-3 margin-top-bottom'>
                <div class="menu-box">
                    <a href="<?php echo SITE_URL . $menu->listing_page; ?>">
                        <?php if($menu->menu_icon) { ?>
                            <div class="menu-icon">
                                <div class="menu-user" style="background-image: url(<?php echo MENU_ICON_PATH . $menu->menu_icon; ?>); "></div>
                            </div>
                        <?php } else { ?>
                            <div class="menu-icon">
                                <div class="menu-user" style="background-image: url(<?php echo MENU_ICON_PATH . 'user.png'; ?>); "></div>
                            </div>
                        <?php } ?> 
                        <span class="menu-name"><?php echo (strlen($menu->menu_name) > 25)? substr($menu->menu_name, 0, 25) . "...": $menu->menu_name ; ?></span>
                    </a>
                </div>
            </div>
    <?php }
    }else {
        foreach ($menus as $menu)  {
        ?>
            <div class='col-md-3 margin-top-bottom'>
                <div class="menu-box">
                    <a href="<?php echo SITE_URL . $menu->listing_page; ?>">
                        <?php if($menu->menu_icon) { ?>
                            <div class="menu-icon">
                                <div class="menu-user" style="background-image: url(<?php echo MENU_ICON_PATH . $menu->menu_icon; ?>); "></div>
                            </div>
                        <?php } else { ?>
                            <div class="menu-icon">
                                <div class="menu-user" style="background-image: url(<?php echo MENU_ICON_PATH . 'user.png'; ?>); "></div>
                            </div>
                        <?php } ?>
                        <span class="menu-name"><?php echo $menu->menu_name; ?></span>
                    </a>
                </div>
            </div>
        <?php
        }
    }
	?>

    <div class='col-md-3 margin-top-bottom'>
        <div class="menu-box">
            <a href="<?php echo SITE_URL . "logout"; ?>">
                <div class="menu-icon">
                    <div class="menu-user" style="background-image: url(<?php echo MENU_ICON_PATH ."logout.png" ?>); "></div>
                </div>
                <span class="menu-name"><?php echo "Logout"; ?></span>
            </a>
        </div>
    </div>

</div>

<!-- Main row -->