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
add_menu_page( 'Sunset Theme Option', 'Sunset', 'manage_options', 'mhgufron-sunset', 'sunset_theme_create_page', get_template_directory_uri() . '/assets/img/sunset-icon.png', '110' );
```

- Buat function yang kita panggil diatas
```php

function sunset_theme_create_page()
{
    // generation of our adimn page
}
```
untuk icon kita bisa memakai gambar png ukuran kecil atau bisa juga menggunakan font Dashicon copy namanya dan paste di param `$icon_menu`
















###
