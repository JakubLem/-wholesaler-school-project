<?php
$GLOBALS['header'] = 5;
@include_once(__DIR__. '/start.php');
?>
<link rel="stylesheet" href="/wholesaler-school-project/core/main/styles/account.css">
<script>
let old_class_name = "register-form-form";
let new_class_name = "register-form-form-invalid";
</script>
<script src="scripts/red_form.js"></script>

<?php
@include_once(__DIR__. '/top.php');

if(isset($_SESSION['register_ok'])) {
    if($_SESSION['register_ok'] == "OK") {
        ?>
            <div class="register_ok">
                <h2>Poprawnie utworzono konto!</h2>
                <h3>Możesz się teraz zalogować!</h3>
                <div class="login-register-form-master">
                    <div class="login-register-form-slave">
                        <div class="login-form">
                            <?php
                                @include_once(__DIR__. '/login.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    } else {
        if($_SESSION['response_code'] == 'null_values') {
            @include_once(__DIR__. '/login_and_register.php');
        ?>
        <script>
            let identifiers = new Array();
            <?php
                foreach ($_SESSION['null_array'] as &$value) {
                    ?>
                        identifiers.push(String("<?php echo $value; ?>"));
                    <?php
                }
            ?>
            make_inputs_red(
                identifiers,
                "register_error_response"
            );
        </script>

        <?php
        }
    }
    unset($_SESSION['register_ok']);
} else if(isset($_SESSION['login'])) {
    if($_SESSION['login'] == "OK") {
        ?>
            <div class="hello-div">
                <p class="hello">Witaj <?php echo $_SESSION['user_name'] ?>!</p>
            </div>
        <?php
        @include_once(__DIR__.'/forms/classes/Cart.php');
        $_SESSION['cart'] = get_product_identifiers_from_user_cart($_SESSION['user_identifier']);

        ?>
            <div class="grid-container">
                <div class="center-container">
                    <script src="scripts/account_view.js"></script>
                    <?php
                        // TODO WSP-36
                        if(isset($_SESSION['cart_important'])){
                            ?>
                                <script>
                                    switch_account_view("to-switch-cart");
                                </script>
                            <?php
                        }
                    ?>
                    <div id="center-container-data" class="center-container-on">
                        <div class="center-container-row">
                            <div class="account-data-container">
                                <?php
                                    if(isset($_SESSION['account_view'])) {
                                        $counter = 0;
                                        foreach ($_SESSION['account_view'] as $key => $value) {
                                            echo '<div class="key-'.$counter.'"> '.$key.' :</div>';
                                            echo '<div class="value-'.$counter.'"> '.$value.' </div>';
                                            $counter++;
                                        }
                                    } else {
                                        echo "Nie udało się załadować danych użytkownika!";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="center-container-orders" class="center-container-off">
                        Tutaj będą widoczne twoje zamówienia
                    </div>
                    <div id="center-container-cart" class="center-container-off">
                        <?php
                        if(empty($_SESSION['cart'])){
                            echo "Twój koszyk jest pusty!";
                        } else {
                        ?>
                            <div class="account-cart-container">
                                <div class="product_name">Nazwa produktu</div>
                                <div class="producer_name">Producent</div>
                                <div class="netto_price">Cena NETTO</div>
                                <div class="quantity">Ilość</div>
                                <div class="value">Wartość</div>
                            </div>
                            <?php 
                                foreach ($_SESSION['cart'] as &$cart) {
                                    echo '<div class="account-cart-container">';
                                    echo '<div class="product_name">'.$cart->product->product_name.'</div>';
                                    echo '<div class="producer_name">'.$cart->product->manufacturer->manufacturer_name.'</div>';
                                    echo '<div class="netto_price">'.$cart->product->get_price().'</div>';
                                    echo '<div class="quantity">';
                                    echo '➖  ';
                                    echo $cart->quantity;
                                    echo '  ➕';
                                    echo '</div>';
                                    echo '<div class="value">'.$cart->quantity*$cart->product->get_price().'</div>';
                                    echo '<div class="delete"><a href="delete.php?id='.$cart->product->identifier.'">Usuń z koszyka</a></div>';
                                    echo '</div>';
                                }
                            }
                        ?>
                        <div class="account-cart-container">
                        </div>
                    </div>   
                </div>
                <div id="to-switch-data" class="data" onclick="switch_account_view(id)">
                    <p>Dane konta</p>
                </div>
                <div id="to-switch-orders" class="orders" onclick="switch_account_view(id)">
                    <p>Twoje zamówienia</p>
                </div>
                <div id="to-switch-cart" class="cart" onclick="switch_account_view(id)">
                    <p>Twój koszyk</p>
                </div>
            </div>
        <?php


    } else if($_SESSION['login'] == "INVALID") {
        @include_once(__DIR__. '/login_and_register.php');
        ?>
        <script src="scripts/account_login.js"></script>
        <script>
            catch_login_errors(String("<?php echo $_SESSION['response_code']; ?>"));
        </script>
        <?php
    }
} else {
    @include_once(__DIR__. '/login_and_register.php');
    if(isset($_SESSION['response_code'])){
        if($_SESSION['response_code'] == 'EMAIL_EXISTS') {
        ?>
            <script>
                let register_false_obj = document.getElementById("register_error_response");
                register_false_obj.innerHTML = "Jest już konto zarejestrowane na podany adres e-mail!";
            </script>
        <?php
        }
    }
    
}
@include_once(__DIR__. '/stop.php');
?>
