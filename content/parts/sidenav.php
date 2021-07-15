<div class="sidebar-content">
   <div class="sidebar-brand">
      <div id="close-sidebar" class="fw-lighter custom-fp-1 pointer">
         <span>
            <i class="fa fa-times-circle"></i>
         </span>
      </div>
   </div>
   <div class="sidebar-header">
      <div class="user-pic">
         <img class="img-responsive img-rounded" src="../../assets/img/user.jpg" alt="User picture">
      </div>
      <div class="user-info">
         <span class="user-name">
            {fname}
         </span>
         <span class="user-role text-capitalize">{pos}</span>
         <span class="user-status">
            <i class="fa fa-circle user-lstatus"></i>
            <span class="user-status-desc">{status}</span>
         </span>
      </div>
   </div>
   <div class="sidebar-menu">
      <ul>
         <li class="header-menu home-menu" style="opacity: 0;">
            <span>Home</span>
         </li>
         <li class="home-menu">
             <a href="#" onclick="contentloader(0)">
                <i class="fa fa-upload"></i>
                <span>Home</span>
             </a>
         </li>
         <div id="side-menus"></div>
      </ul>
   </div>
</div>
<div class="sidebar-footer hidden">
   <a href="#">
      <i class="fa fa-bell"></i>
      <span class="badge badge-pill badge-warning notification">3</span>
   </a>
   <a href="#">
      <i class="fa fa-envelope"></i>
      <span class="badge badge-pill badge-success notification">7</span>
   </a>
   <a href="#">
      <i class="fa fa-cog"></i>
      <span class="badge-sonar"></span>
   </a>
   <a onclick="logout();" class="pointer">
      <i class="fa fa-power-off"></i>
   </a>
</div>
<script>
   $.ajax({
      url: '../../content/action/getMenu.php',
      success: function(data) {
         $("#side-menus").html(data);
      }
   });
   function logout() {
      Cookies.remove('appid');
      $.ajax({
         type: "GET",
         url: '../../content/action/formlogout.php',
         success: function(data) { location.reload(); }
      });
   }
 </script>