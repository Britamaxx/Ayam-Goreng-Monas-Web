<?php
$conn = mysqli_connect("localhost", "root", "", "ayamgoreng_monas");

$tipe = $_POST['tipe']; 

if (!empty($_FILES['logo']['name'])) {
    $nama_file = $_FILES['logo']['name'];
    $tmp = $_FILES['logo']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $nama_file);

    $logo_sql = ", logo = '$nama_file' ";
} else {
    $logo_sql = "";
}

if ($tipe == "header") {

    $nama = $_POST['nama_bisnis'];
    $url  = $_POST['location_url'];

    mysqli_query($conn,
        "UPDATE header SET 
            nama_bisnis = '$nama',
            location_url = '$url'
            $logo_sql
        WHERE id = 1"
    );

    header("Location: admin_edit_header.php?success=1");
    exit;

}

else if ($tipe == "footer") {

    mysqli_query($conn,
        "UPDATE footer SET 
            slogan = '{$_POST['slogan']}',
            link_story = '{$_POST['link_story']}',
            link_menu = '{$_POST['link_menu']}',
            link_news = '{$_POST['link_news']}',
            whatsapp = '{$_POST['whatsapp']}',
            email = '{$_POST['email']}',
            alamat = '{$_POST['alamat']}',
            maps_embed = '{$_POST['maps_embed']}',
            instagram = '{$_POST['instagram']}',
            tiktok = '{$_POST['tiktok']}',
            x = '{$_POST['x']}',
            facebook = '{$_POST['facebook']}'
            $logo_sql
        WHERE id = 1"
    );

    header("Location: admin_edit_footer.php?success=1");
    exit;
}

?>
