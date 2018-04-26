# Wordpress Theme Development

## A. Catatan Tutorial

### 1. Custom Font Icon and Folder Structure
Untuk membuat custom font icon kita membutuhkan file svg download file svg dari github yang sudah disediakan
buka [icomon.io](https://icomoon.io/app/) klik 3 strip menu bar pilih `Manage Project` tulis nama Project
pilih `Import Icon` di menu klik `Generate Font` klik `Prefences` custom sesuai keinginan
contoh:  
- Font Name : sunset-icon
- Class Prefix : sunset
- CSS Selector : use a class = .sunset-icon

Aktifkan WP_Debug di `config.php` di root wordpress Untuk mengecek apakah ada code yang error caranya
- Buka file `config.php`
- Search `WP_Debug` ubah value menjadi true dan save file

Folder Structure
saya mengambil folder structure sama seperti tema bawaan wp yang terakhir saat ini yaitu `twenty seventeen`
- `sunsettheme` folder
  - `assets` folder
    - `css` folder
    - `js` folder
    - `font` folder
    - `sass` folder
  - `inc` folder function
  - `template-parts` folder
  - `footer.php` file
  - `header.php` file
  - `index.php` file
  - `screenshot.png` file
  - `style.css` file  

Make Blank Theme  
`header.php` `<?php get_header(); ?>`  
`footer.php` `<?php get_footer(); ?>`  
`index.php` `<?php the_header(); ?><?php the_footer(); ?>`  


### 2. How to create a Custom Admin Page

- Buat file `functions.php` untuk membuat function dan mengaktifkan beberapa fitur wordpress seperti widget, menu dll. Didalam folder `inc` buat file `function-admin.php` untuk mempermudah pembacaan jadikan `function-{part}.php` sebagai prefix. include file `function-admin.php`  ke `functions.php` denggan cara
```php
<?php

require get_template_directory() . '/inc/function-admin.php'
```
di file `function.php`

- Buat function di `function-admin.php` gunakan comment setiap sebelum function agar codingan mudah dibaca
copy script di file `function-admin.php`
```php
<?php

/*
@package sunsettheme
    =========================
        ADMIN PAGE
    =========================
 */

function sunset_add_admin_page()
{

}
```

- Panggil function `add_menu_page()`
```php
/*parameter yang digunakan dalam function  `add_menu_page()`
add_menu_page(
  $title_page,
  $label_menu,
  $role,
  $slug,
  $function,
  $icon_menu,
  $urutan_index
)
 */
add_menu_page( 'Sunset Theme Option', 'Sunset', 'manage_options', 'mhgufron_sunset', 'sunset_theme_create_page', get_template_directory_uri() . '/assets/img/sunset-icon.png', '110' );
```

- Buat function yang kita panggil diatas
```php

function sunset_theme_create_page()
{
    // generation of our adimn page
}
```
untuk icon kita bisa memakai gambar `.png` ukuran kecil atau bisa juga menggunakan font `Dashicon` copy namanya dan paste di param `$icon_menu` misal `dashicons-art`

### 3. How to create Admin SubPages

Untuk membuat `subpage` tambahkan function `add_submenu_page()` dalam function `sunset_add_admin_page()`
```php
add_submenu_page( 'mhgufron_sunset', 'Sunset Theme Option', 'General', 'manage_options', 'mhgufron_sunset', 'sunset_theme_create_page' );
```
function submenu diatas memiliki slug dan function yang sama denga parent sehingga akan menimpa submenu bawaan parentnya

Buat 1 lagi submenu
```php
add_submenu_page( 'mhgufron_sunset', 'Sunset CSS Option', 'Custom CSS', 'manage_options', 'mhgufron_sunset_css', 'sunset_theme_settings_page' );
```

Jangan lupa buat function yang dipakai submenu dan tuliskan beberapa kode untuk di tampilkan di panel menu
```php
function sunset_theme_create_page()
{
    echo "<h1>Sunset Theme Option</h1>";
}

function sunset_theme_settings_page()
{
    echo "<h1>Sunset Custom CSS</h1>";
}
```
Jika kita menuliskan semua kode html di dalam fungsi seperti diatas akan sulin untuk mencari error dan terlalu banyak baris yang di gunakan maka kita bisa memisahkan perpanel jadi kita hanya menginclude file saja di dalam function.

Buat file di `/inc/templates/` dengan nama `sunset-admin.php`
```php
<h1>Sunset Theme Option</h1>
<h3 class="title">Manage Options</h3>
<p>Customize the default Wordpress Appearance Options</p>
<?php bloginfo( 'name' ); ?>

```

require file `function-admin.php`
```php
function sunset_theme_create_page()
{
    require_once get_template_directory() . '/inc/function-admin.php';
}
```

### 4. Create Custom Options with Settings API

Tambahkan `add_action()` di fungsi `sunset_add_admin_page()`
```php
// Activate custom settings
add_action( 'admin_init', 'sunset_custom_settings');
```

Buat function `sunset_custom_settings` dan tambahkan function `register_setting()`
```php
function sunset_custom_settings()
{
    register_setting( 'sunset-settings-group', 'first_name');
}
```

Buat form input di `sunset-admin.php` replace dengan kode dibawah
```php
<h1>Sunset Theme Option</h1>
<h3 class="title">Manage Options</h3>
<p>Customize Sidebar Option</p>

<form action="" method="post">
    <?php settings_fields( 'sunset-settings-group' ) ?>
</form>
```

Tambahkan fungsi `add_settings_section()` dalam function `sunset_custom_settings()`
add_settings_section($param_1, $param_2, $param_3, $param_4, $param_5)
`$param_1` id dari settings section
`$param_2` judul dari section
`$param_3` function yang dipanggil di section
`$param_4` id page dimana section ini akan ditampilkan
```php
add_settings_section( 'sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'mhgufron_sunset' );
```

Buat function `sunset_sidebar_options()`
```php
function sunset_sidebar_options()
{
    echo "Customize your Sidebar Information";
}
```

Tambahkan fungsi `do_settings_sections()` di `sunset-admin.php` dengan parameter `nama section` dan fungsi `submit_button()` replace `sunset-admin.php` dengan kode dibawah
```php
<h1>Sunset Theme Option</h1>

<?php settings_errors(); ?>

<form action="options.php" method="post">
    <?php settings_fields( 'sunset-settings-group' ); ?>
    <?php do_settings_sections( 'mhgufron_sunset' ); ?>
    <?php submit_button(); ?>
</form>
```

Tambahkan fungsi `add_settings_field()` di bawah fungsi `add_settings_section()` dalam file `function-admin.php`
> add_settings_field( $id, $title, $calback, $page, $section, $args)  

```php
add_settings_field( 'sidebar-name', 'First Name', 'sunset_sidebar_name', 'mhgufron_sunset', 'sunset-sidebar-options' );
```
Buat fungsi dari calback di atas
```php

```


###

















###
