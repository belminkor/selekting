<!-- header-search -->
<div class="header-search f-left">
    <div class="header-search-inner">
       <button class="search-toggle">
        <i class="zmdi zmdi-search"></i>
       </button>
        <form method="POST" action="products.php">
            <div class="top-search-box">
                <input type="text" name="pretraga" placeholder="Unesite naziv ili šifru proizvoda...">
                <button type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </form> 
    </div>
</div>
<!-- total-cart -->
<div class="total-cart f-left">
    <div class="total-cart-in">
        <div class="cart-toggler">
            <a href="cart.php">
                <span class="cart-quantity"><?php include "cartcount.php"; ?></span><br>
                <span class="cart-icon">
                    <i class="zmdi zmdi-shopping-cart-plus"></i>
                </span>
            </a>                            
        </div>
    </div>
</div>