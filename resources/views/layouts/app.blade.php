<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel SPT</title>
  <style>
   body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-color: #ffffff; /* Default page background */
}

.page-container {
  max-width: 1440px;
  margin: 0 auto;
  position: relative;
}

/* CSS from section:admin-panel */
.admin-panel-section {
  min-height: 960px; /* Height of the background image area */
  background-color: #ffffff; /* Fallback for area below background image */
}
.admin-panel-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%; /* Takes width of .page-container (1440px max) */
  height: 960px;
  z-index: 0; /* Behind content */
  overflow: hidden; /* Ensure image doesn't spill if somehow larger */
}
.admin-panel-background .bg-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.admin-panel-background .bg-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #000000; /* style_3 */
  opacity: 0.45; /* style_3 */
}
.admin-panel-content {
  position: relative;
  z-index: 1; /* On top of background */
}
.admin-header { /* Based on 683:784 */
  height: 88px;
  background-color: rgba(37, 37, 37, 0.5); /* style_4: #252525, opacity 0.5 */
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 40px; 
  box-sizing: border-box;
}
.admin-header .logo { /* 683:788 */
  font-family: 'Young Serif', serif;
  font-size: 35px;
  font-weight: 400;
  background: linear-gradient(146deg, #a2f6ff 40.16%, #48c6d4 177.69%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-fill-color: transparent;
}
.admin-header .user-actions {
  display: flex;
  align-items: center;
  gap: 25px; /* Approx (9803_icon_x - (9684_btn_x + 74_btn_width)) */
}
.admin-header .logout-button { /* I683:790;569:1135 */
  height: 28px;
  padding: 0 10px;
  background-color: #d0d0d0; /* style_11 */
  border-radius: 15px; /* style_11 */
  color: #000000; /* style_12 */
  font-family: 'Poppins', sans-serif;
  font-size: 14px; /* style_12 */
  font-weight: 500; /* style_12 */
  line-height: 28px; /* Vertically center text */
  text-decoration: none;
  display: inline-block;
  box-sizing: border-box;
}
.admin-header .user-icon img { /* 683:823 */
  width: 36px;
  height: 36px;
  display: block;
}

.dashboard-layout {
  display: flex;
}
.sidebar { /* 683:785 */
  width: 262px;
  height: 872px; 
  background-color: #c0c0c0; /* style_5 */
  padding-top: 20px; /* y_search_group=-3870 vs y_sidebar=-3890 */
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
}
.sidebar .search-bar { /* 683:808 */
  margin-left: 28px; /* x_search_group=8537 vs x_sidebar=8509 */
  margin-right: 28px; /* (262_sidebar_w - 28_margin_left - 206_search_rect_w) */
  background-color: #090909; /* style_19 */
  border-radius: 15px; /* style_19 */
  height: 30px;
  padding: 0 15px;
  display: flex;
  align-items: center;
  box-sizing: border-box;
}
.sidebar .search-bar input {
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.55); /* style_21 */
  font-family: 'Poppins', sans-serif;
  font-size: 11px; /* style_21 */
  font-weight: 600; /* style_21 */
  flex-grow: 1;
  line-height: 24px; /* style_21 */
}
.sidebar .search-bar input::placeholder {
  color: rgba(255, 255, 255, 0.55);
  opacity: 1;
}
.sidebar .search-bar img { /* 683:810 */
  width: 20px;
  height: 20px;
}
.sidebar .nav-item {
  display: flex;
  align-items: center;
  height: 36px; /* From Figma node */
  background-color: #090909; /* style_22, style_25 */
  color: #ffffff; /* style_23 */
  font-family: 'Poppins', sans-serif;
  font-size: 15px; /* style_23 */
  font-weight: 600; /* style_23 */
  text-decoration: none;
  box-sizing: border-box;
  padding: 0 15px 0 25px; /* General padding, text/icon specific margin below */
}
.sidebar .nav-item .nav-text {
  margin-left: 27px; /* (8589_text_prod_x - 8509_sidebar_x) - 25_item_padding_left - 28_item_margin_left (if item not full width) */
  /* Simplified: Text 'Product' x=8589. Item background x=8509. So text is 80px from sidebar left.
     Item padding-left 25px. So text margin-left = 80-25 = 55px. */
  /* Let's use fixed padding on item and let flex handle internal spacing */
  flex-grow: 1;
}
.sidebar .nav-item .nav-icon {
  margin-left: 10px; /* Space between text and icon */
  width: 21px; 
  height: 21px;
}
.sidebar .nav-item.product-link { /* 683:813 / 683:814 */
  width: 234px;
  border-radius: 0px 18px 18px 0px; /* style_22 */
  margin-top: 49px; /* (y_prod_link=99 from sidebar top) - (20_search_top_pad + 30_search_h) */
  padding-left: (8589.65 - 8509)px; /* Align text start */
}
.sidebar .nav-item.user-link { /* 683:818 / 683:819 */
  width: 206px;
  border-radius: 0px 18px 18px 0px; /* Visually better than 0 18 0 0 from style_25 */
  margin-top: 30px; /* (y_user_link=-3725) - (y_prod_link=-3791 + h_prod_link=36) */
  padding-left: (8594 - 8509)px; /* Align text start */
}

.main-content-area { /* 683:840 */
  flex-grow: 1;
  background-color: #e8e8e8; /* style_28 */
  border-radius: 10px; /* style_28 */
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); /* style_28 */
  margin-left: 100px; /* (x_table=8871 - (x_sidebar=8509 + w_sidebar=262)) */
  margin-top: 99px;  /* (y_table_abs=187 - y_header_h=88) */
  /* height: 627px; -- Let content define height or use min-height if needed */
  padding: 25px; 
  box-sizing: border-box;
}
.table-header-controls {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px; /* y_table_header_text=-3733 vs y_tambah_btn=-3733. Line 687:807 is at y=-3684. Table content starts below. */
}
.product-table {
  width: 100%;
  border-collapse: collapse;
  font-family: 'Poppins', sans-serif;
  font-size: 13px; /* style_29 */
  font-weight: 500; /* style_29 */
  color: #000000; /* style_29 */
  text-align: center; /* style_29 */
}
.product-table th, .product-table td {
  padding: 18px 10px; /* Approximate, to make rows ~80-90px high */
  border-bottom: 1px solid rgba(0, 0, 0, 0.7); /* style_35, style_36, etc. */
}
.product-table thead th { 
   border-bottom-width: 2px; /* Line 687:807 is thicker */
   padding-bottom: 18px; /* Align with row content */
   vertical-align: middle;
}
.product-table tr:last-child td {
  border-bottom: none;
}
.product-table .col-no { width: 5%; text-align: center;}
.product-table .col-name { width: 15%; text-align: left;}
.product-table .col-desc { width: 25%; text-align: left;}
.product-table .col-price { width: 10%; text-align: center;}
.product-table .col-image { width: 10%; text-align: center;}
.product-table .col-actions { width: 20%; text-align: center;}

.product-table .product-image { /* 687:797 */
  width: 46px; 
  height: 83px; 
  object-fit: contain; 
  border-radius: 5px; /* style_30 */
  vertical-align: middle;
}
.product-table .action-button {
  padding: 4px 15px; /* (27_btn_h - 19.5_text_line_h)/2 */
  border-radius: 5px; /* style_31, style_33, style_34 */
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  color: #000000; /* style_32 */
  font-family: 'Poppins', sans-serif;
  font-size: 13px; /* style_32 */
  font-weight: 500; /* style_32 */
  text-decoration: none;
  border: none;
  cursor: pointer;
  margin: 0 5px;
  line-height: 19.5px; /* style_32 */
}
.product-table .edit-button { background-color: #21f65a; /* style_31 */ }
.product-table .delete-button { background-color: #f81a1a; /* style_33 */ }
.product-table .add-button { background-color: #48c6d4; /* style_34 */ }

@media (max-width: 1200px) {
  .main-content-area { margin-left: 30px; margin-top: 30px; }
}
@media (max-width: 992px) {
  .admin-header { padding: 0 20px; }
  .admin-header .user-actions { gap: 15px; }
  .dashboard-layout { flex-direction: column; }
  .sidebar { width: 100%; height: auto; padding-bottom: 20px; }
  .sidebar .nav-item.product-link, .sidebar .nav-item.user-link { 
    width: auto; margin-left: 28px; margin-right: 28px; padding-left: 25px; 
  }
  .main-content-area { margin-left: 0; margin-top: 20px; }
  .product-table { font-size: 12px; }
  .product-table .col-desc { display: none; } /* Hide description on smaller table */
  .product-table .col-name { width: 20%;}
  .product-table .col-actions { width: 25%;}
}
@media (max-width: 768px) {
  .admin-panel-section { min-height: auto; }
  .admin-panel-background { height: 400px; }
  .admin-header .logo { font-size: 28px; }
  .admin-header .logout-button { font-size: 12px; padding: 0 8px; height: 24px; line-height: 24px;}
  .admin-header .user-icon img { width: 28px; height: 28px; }
  .table-header-controls { margin-bottom: 10px; }
  .product-table th, .product-table td { padding: 10px 5px; }
  .product-table .action-button { padding: 3px 10px; margin: 2px; font-size: 12px; }
  .product-table .col-price, .product-table .col-image { display: none; } /* Further hide columns */
  .product-table .col-name { width: 40%;}
  .product-table .col-actions { width: 35%;}
}

/* CSS from section:footer */
.site-footer {
  background-color: #114b5b; /* style_13 */
  color: #ffffff;
  padding: 75px 40px; /* y_logo_footer=75. x_logo_footer=90, but use less for responsiveness */
  font-family: 'Poppins', sans-serif;
  margin-top: 0; /* Ensure it connects if previous section ends at 960px */
}
.footer-content-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: flex-start; 
  max-width: 1260px; 
  margin: 0 auto; /* Center content within the 1440px page-container */
}
.footer-left {
  flex-basis: 55%; /* Give more space to text */
  padding-right: 40px; /* Space before nav */
}
.footer-logo { /* 683:798 */
  font-family: 'Young Serif', serif;
  font-size: 35px; /* style_16 */
  font-weight: 400; /* style_16 */
  line-height: 49.42px; /* style_16 */
  margin-bottom: 30px; /* (y_tentang_title=-2863) - (y_logo=-2942 + h_logo=49) */
}
.about-spt h3 { /* 683:796 */
  font-family: 'Young Serif', serif;
  font-size: 20px; /* style_15 */
  font-weight: 400; /* style_15 */
  line-height: 28.24px; /* style_15 */
  margin-top: 0;
  margin-bottom: 7px; /* (y_para=-2828) - (y_title=-2863 + h_title=28) */
}
.about-spt p { /* 683:795 */
  font-size: 25px; /* style_14 - Note: This is quite large for paragraph text. */
  font-weight: 400; /* style_14 */
  line-height: 37.5px; /* style_14 */
  margin: 0;
}
.footer-nav { /* 683:799 */
  display: flex;
  flex-direction: column; /* Stack vertically as in many footers */
  align-items: flex-start;
  gap: 20px; /* style_17 gap is 45px, but vertical might need less */
  margin-top: 10px; /* Align roughly with top of "Tentang SPT" text */
  flex-basis: 40%;
}
.footer-nav a {
  color: #ffffff; /* style_18 */
  font-size: 20px; /* style_18 */
  font-weight: 600; /* style_18 */
  line-height: 30px; /* style_18 */
  text-decoration: none;
}

@media (max-width: 992px) {
  .footer-content-wrapper {
    flex-direction: column;
    gap: 40px;
  }
  .footer-left {
    flex-basis: auto;
    padding-right: 0;
  }
  .footer-nav {
    margin-top: 0;
    flex-basis: auto;
    gap: 15px;
  }
  .about-spt p { font-size: 20px; line-height: 1.5; } /* Adjust large font */
}
@media (max-width: 768px) {
  .site-footer { padding: 40px 20px; }
  .footer-logo { font-size: 28px; margin-bottom: 20px; }
  .about-spt h3 { font-size: 18px; }
  .about-spt p { font-size: 16px; }
  .footer-nav a { font-size: 18px; }
}
  </style>
</head>
<body>
<section id="admin-panel" class="page-container admin-panel-section">
  <div class="admin-panel-background">
    <img src="../external/pabrik1.jpg" alt="Factory background" class="bg-image" />
    <div class="bg-overlay"></div>
  </div>
  <div class="admin-panel-content">
    <!-- Header -->
    <header class="admin-header">
      <div class="logo">SPT</div>
      <div class="user-actions">
        <a href="#" class="logout-button">Log Out</a>
        <div class="user-icon">
          <img src="/page/9ede0eec-2af2-4bdd-a7e8-ff4f7e183177/images/683_823.svg" alt="User" width="40" height="40" style="border-radius:50%;">
        </div>
      </div>
    </header>

    <!-- Dashboard layout -->
    <div class="dashboard-layout">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="search-bar">
          <input type="text" placeholder="Search" />
          <img src="/page/9ede0eec-2af2-4bdd-a7e8-ff4f7e183177/images/683_810.svg" alt="Search Icon" width="20" height="20" />
        </div>
        <a href="#" class="nav-item product-link">
          <span class="nav-text">Product</span>
          <img src="/page/9ede0eec-2af2-4bdd-a7e8-ff4f7e183177/images/683_816.svg" alt="Product Icon" class="nav-icon" width="20" height="20" />
        </a>
        <a href="#" class="nav-item user-link">
          <span class="nav-text">User</span>
          <img src="/page/9ede0eec-2af2-4bdd-a7e8-ff4f7e183177/images/683_821.svg" alt="User Icon" class="nav-icon" width="20" height="20" />
        </a>
      </aside>

      <!-- Main Content -->
      <main class="main-content-area">
        @yield('content')
      </main>
    </div>
  </div>
</section>

<!-- Footer -->
<footer id="page-footer" class="page-container site-footer">
  <div class="footer-left">
    <div class="footer-logo">SPT</div>
    <div class="about-spt">
      <h3>Tentang SPT</h3>
      <p>Perusahaan Peternakan terintegrasi yang memberikan produk terbaik kepada konsumen. Kami berpengalaman di bidang peternakan dengan sistem teknologi terbaru, serta spesialis dalam bidang produksi hasil pertanian dan peternakan.</p>
    </div>
  </div>
  <nav class="footer-nav">
    <a href="#home">HOME</a>
    <a href="#about">ABOUT SPT</a>
    <a href="#product">OUR PRODUCT</a>
    <a href="#contact">CONTACT US</a>
  </nav>
</footer>
</body>
</html>