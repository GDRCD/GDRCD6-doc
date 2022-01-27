<div class="central_body container-fluid">

    <div class="row">


        <div class="content_box col">
            <div class="header row">
                {include file="header.tpl"}
            </div>
            <div class="content_body row">
                <div class="menu_box col-2">
                    {include file="menu.tpl"}
                </div>
                <div class="content col pl-4">
                    <div class="menu_commands">
                        <div class="close-menu">
                            <i class="fas fa-arrow-left"></i>
                        </div>

                        <div class="open-menu">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>

                    {include file="{{$file_name}}.tpl"}
                </div>
            </div>
            <div class="footer row">
                {include file="footer.tpl"}
            </div>
        </div>
    </div>

</div>


