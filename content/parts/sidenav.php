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
         <span class="user-role">{pos}</span>
         <span class="user-status">
         <i class="fa fa-circle"></i>
         <span>{status}</span>
         </span>
      </div>
   </div>
   <div class="sidebar-search hidden">
      <div>
         <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
            <i class="fa fa-search" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search" autocomplete="off">
         </div>
      </div>
   </div>
   <div class="sidebar-menu">
      <ul>
         <li class="header-menu" style="opacity: 0;">
            <span>Home</span>
         </li>
         <li>
            <a href="#" onclick="contentloader(0)">
               <i class="fa fa-upload"></i>
               <span>Home</span>
            </a>
         </li>
         <li class="header-menu">
            <span>HR</span>
         </li>
         <li class="sidebar-dropdown">
            <a href="#">
            <i class="fas fa-user"></i>
            <span>Employee</span>
            </a>
            <div class="sidebar-submenu">
               <ul>
                  <li>
                     <a href="#" onclick="contentloader(3)">Information</a>
                  </li>
                  <li>
                     <a href="#" class="text-danger">Attendance</a>
                  </li>
                  <li>
                     <a href="#" class="text-danger">Online Forms</a>
                  </li>
               </ul>
            </div>
         </li>
         <li class="header-menu">
            <span>Accounting</span>
         </li>
         <li class="sidebar-dropdown">
            <a href="#">
               <i class="fa fa-file"></i>
               <span>Reports</span>
            </a>
            <div class="sidebar-submenu">
               <ul>
                  <li>
                     <a href="#" onclick="contentloader(12)">Booked</a>
                  </li>
                  <li>
                     <a href="#" class="text-danger">Commission</a>
                  </li>
                  <li>
                     <a href="#" class="text-danger">Delivered</a>
                  </li>
                  <li>
                     <a href="#" onclick="contentloader(4)">Raw Data</a>
                  </li>
                  <li>
                     <a href="#" onclick="contentloader(6)">AG Data</a>
                  </li>
               </ul>
            </div>
         </li>
         <li>
            <a href="#" onclick="contentloader(11)">
               <i class="fab fa-wpforms"></i>
               <span>PCV</span>
            </a>
         </li>
         <li class="header-menu">
            <span>Extra</span>
         </li>
         <li>
            <a href="#" onclick="contentloader(1)">
               <i class="fa fa-upload"></i>
               <span>OSD Uploader</span>
            </a>
         </li>
         <li class="sidebar-dropdown">
            <a href="#">
            <i class="fa fa-database"></i>
            <span>Data</span>
            </a>
            <div class="sidebar-submenu">
               <ul>
                  <li>
                     <a href="#" onclick="contentloader(9)">Customer</a>
                  </li>
                  <li>
                     <a href="#" onclick="contentloader(10)">Products</a>
                  </li>
               </ul>
            </div>
         </li>
         <li>
            <a href="#" class="text-danger">
               <i class="fa fa-book"></i>
               <span>Documentation</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="contentloader(2)">
               <i class="fa fa-calendar"></i>
               <span>Calendar</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="contentloader(5)">
               <i class="fa fa-bullhorn"></i>
               <span>Announcement</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="contentloader(8)">
               <i class="fas fa-terminal"></i>
               <span>Command</span>
            </a>
         </li>
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
   $(".sidebar-dropdown > a").click(function() {
      $(".sidebar-submenu").slideUp(200);
      if ($(this).parent().hasClass("active")) {
         $(".sidebar-dropdown").removeClass("active");
         $(this).parent().removeClass("active");
      }
      else {
         $(".sidebar-dropdown").removeClass("active");
         $(this).next(".sidebar-submenu").slideDown(200);
         $(this).parent().addClass("active");
      }
   });
   $("#close-sidebar").click(function() { $(".page-wrapper").removeClass("toggled");});
   $("#show-sidebar").click(function() { $(".page-wrapper").addClass("toggled"); });
   $("#page-content").click(function(e) {
      if (e.ctrlKey) {
         if ($(".page-wrapper").hasClass("toggled")) { $(".page-wrapper").removeClass("toggled"); }
         else { $(".page-wrapper").addClass("toggled"); }
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