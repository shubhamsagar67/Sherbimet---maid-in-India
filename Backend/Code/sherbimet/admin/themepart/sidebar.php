  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $project_title;?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
<!--          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
            <img src="images/profile/<?php echo $admin_profile;?>" style="width: 33.59px;height: 33.59px"  class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile-edit.php" class="d-block"><?php echo $admin_name;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
<!--          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>-->
           <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
               <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
              </p>
            </a>
          </li>
        
      
            <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
            
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Service
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 <li class="nav-item">
                <a href="service-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="service-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Service</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
            
              <i class="nav-icon fab fa-stripe-s"></i>
              <p>
                Subservice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 <li class="nav-item">
                <a href="subservice-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Subservice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="subservice-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Subservice</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
		  
          <a href="#" class="nav-link">
          
            <i class="nav-icon fas fa-cubes"></i>
            <p>
              Package
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
               <li class="nav-item">
              <a href="package-add.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Package</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="package-list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Package</p>
              </a>
            </li>
            
          </ul>
        </li>
     

          
<!--              <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
              
              <i class="nav-icon fab fa-first-order-alt"></i>  
              
              <p>
                Manage Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

 <li class="nav-item">
                <a href="orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="booking.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-detail-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Detail</p>
                </a>
              </li>
              
                <li class="nav-item">
                <a href="shipping-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shipping</p>
                </a>
              </li>
             
              
            
            </ul>
          </li>-->
          
<!--              <li class="nav-item">
            <a href="faq-list.php" class="nav-link">
              
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
               FAQ
              </p>
            </a>
          </li>-->
<!--             <li class="nav-item">
            <a href="cost-list.php" class="nav-link">
              
              <i class="nav-icon fas fa-file"></i>
              <p>
               Cost
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="service-list.php" class="nav-link">
              
              <i class="nav-icon fas fa-book"></i>
              <p>
               Service
              </p>
            </a>
          </li>
  <li class="nav-item">
            <a href="gardner-list.php" class="nav-link">
              
              <i class="nav-icon fas fa-book"></i>
              <p>
              Gardner
              </p>
            </a>
          </li>-->
           <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
              
              <i class="nav-icon fas fa-users"></i>
              <p>
                 User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                   <li class="nav-item">
                <a href="user-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="user-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
              
              
              

            
            </ul>
          </li>
          
          
            <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
              
              <i class="nav-icon fas fa-user"></i>
              <p>
                 Worker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                   <li class="nav-item">
                <a href="worker-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Worker</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="worker-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Worker</p>
                </a>
              </li>

            
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="booking-list.php" class="nav-link">
               <i class="nav-icon fas fa-money-bill"></i>
              <p>
               Booking List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="feedback-list.php" class="nav-link">
               <i class="nav-icon fas fa-comments"></i>
              <p>
               Feedback List
              </p>
            </a>
          </li>
        
        

          <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
               City
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="city-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="city-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View City</p>
                </a>
              </li>
            
            </ul>
          </li>
          <li class="nav-item has-treeview">
		  
      <a href="#" class="nav-link">

        <i class="nav-icon fas fa-map-marker-alt"></i>
        <p>
         Area
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="area-add.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Area</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="area-list.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Area</p>
          </a>
        </li>
      
      </ul>
    </li>
          <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
               Pincode
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="pincode-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Pincode</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pincode-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Pincode</p>
                </a>
              </li>
            
            </ul>
          </li>
          <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
            
              <i class="nav-icon fas fa-language"></i>
              <p>
               Language
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="language-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Language</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="language-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Language</p>
                </a>
              </li>
            
            </ul>
          </li>
       
          
              <li class="nav-item has-treeview">

                <a href="#" class="nav-link">

                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                <li class="nav-item">
                      <a href="rpt-subservice.php" target="_blank" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Subservice</p>
                    </a>
                  </li>
                  <li class="nav-item">
                      <a href="rpt-package.php" target="_blank" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Package</p>
                    </a>
                  </li>
               <li class="nav-item">
                      <a href="rpt-user.php" target="_blank" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                      <a href="rpt-worker.php" target="_blank" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Worker</p>
                    </a>
                  </li>
                 
                     <li class="nav-item">
                      <a href="rpt-booking.php" target="_blank" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Booking</p>
                    </a>
                  </li> 
                  <li class="nav-item">
                      <a href="rpt-feedback.php" target="_blank" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Feedback</p>
                    </a>
                  </li> 

                  
                  


                </ul>
              </li>
          
          <li class="nav-item has-treeview">
		  
            <a href="#" class="nav-link">
<i class="nav-icon fas fa-cogs"></i>
            
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="change-password.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="profile-edit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
            
            </ul>
          </li>
    
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>