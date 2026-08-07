<?php 
// 1. Session start karein taaki login user ki ID mil sake
session_start();
include('api/db.php'); 

// Testing ke liye: Agar session nahi hai toh kisi dummy ID ko use karein (Varna real app mein login check lagayein)
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MP Tourism Sathi Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary: #e67e22; --dark: #1a1a1a; --admin: #2c3e50; }
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f0f2f5; scroll-behavior: smooth; }
        nav { background: #fff; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        nav h1 { font-family: 'Montserrat'; color: var(--primary); font-size: 26px; }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--dark); margin-left: 20px; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .nav-links a:hover { color: var(--primary); }
        .admin-link { background: #fdf2e9; color: var(--primary) !important; padding: 8px 15px; border-radius: 10px; border: 1px dashed var(--primary); }
        .admin-link:hover { background: var(--primary) !important; color: #fff !important; }
        .logout-btn { background: var(--primary); color: #fff !important; padding: 10px 22px; border-radius: 50px; box-shadow: 0 4px 10px rgba(230,126,34,0.3); }
        .hero { height: 400px; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://www.mptourism.com/images/bhedaghat-marble-rocks-tourism.jpg'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; color: #fff; text-align: center; border-bottom: 5px solid var(--primary); }
        .hero h2 { font-family: 'Montserrat'; font-size: 45px; text-transform: uppercase; }
        .search-container { margin-top: -30px; display: flex; justify-content: center; }
        .search-bar { background: #fff; padding: 15px 30px; border-radius: 50px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 60%; display: flex; align-items: center; }
        .search-bar input { border: none; outline: none; width: 100%; font-size: 16px; margin-left: 10px; }
        .container { padding: 60px 5%; }
        .tour-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; }
        .card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: 0.4s; }
        .image-box { height: 200px; position: relative; }
        .image-box img { width: 100%; height: 100%; object-fit: cover; }
        .badge { position: absolute; top: 15px; right: 15px; background: var(--primary); color: #fff; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .card-body { padding: 20px; }
        .book-btn { background: var(--dark); color: #fff; padding: 12px; border-radius: 12px; border: none; width: 100%; cursor: pointer; font-weight: 600; }
        .book-btn:hover { background: var(--primary); }
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px); justify-content: center; align-items: center; }
        .modal-content { background: #fff; padding: 30px; border-radius: 20px; width: 400px; text-align: center; position: relative; }
        .modal input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 10px; }
        .close-modal { position: absolute; top: 15px; right: 15px; font-size: 20px; cursor: pointer; }
    </style>
</head>
<body>

<nav>
    <h1>MP TOURISM <span style="font-weight:300; color:#555;">SARTHI</span></h1>
    <div class="nav-links">
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="admin.php" class="admin-link"><i class="fas fa-user-shield"></i> Admin Panel</a>
        
        <a href="javascript:void(0)" 
onclick="document.getElementById('support-section').scrollIntoView({behavior:'smooth'});" 
class="support-btn">

<i class="fas fa-headset"></i> Support

</a>
        <a href="index.php" class="logout-btn">Logout</a> 
               
  
    </div>
</nav>

<section class="hero">
    <h2>The Heart of Incredible India</h2>
    <p>Premium Travel Portal for Madhya Pradesh</p>
</section>

<div class="search-container">
    <div class="search-bar">
        <i class="fas fa-search" style="color:#999;"></i>
        <input type="text" placeholder="Search destinations...">
    </div> 
</div>

<div class="container">
    <div class="tour-grid">
        <?php
        
       
$destinations = [


["Khajuraho","UNESCO Heritage Temples famous for sculpture art.","https://upload.wikimedia.org/wikipedia/commons/d/d5/Khajuraho-Lakshmana_temple.JPG","History"],
["Jabalpur - Bhedaghat Dhuandhar Waterfall","Marble Rocks and Dhuandhar Falls in Jabalpur.","https://upload.wikimedia.org/wikipedia/commons/0/08/Purwa_Falls_2013.jpg","Nature"],
["Kanha National Park","India's famous tiger reserve and jungle safari.","https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Tiger_Kanha_National_Park.jpg/960px-Tiger_Kanha_National_Park.jpg","Wildlife"],
["Pachmarhi","Queen of Satpura with hills and waterfalls.","https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Pachmarhi_valley_Madhya_Pradesh_INDIA.jpg/500px-Pachmarhi_valley_Madhya_Pradesh_INDIA.jpg","Hill Station"],
["Ujjain Mahakaleswar","Mahakaleshwar Jyotirlinga and spiritual city.","https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Mahakaleshwar_Temple%2C_Ujjain.jpg/500px-Mahakaleshwar_Temple%2C_Ujjain.jpg","Religious"],

["Sanchi Stupa","Historic Buddhist Stupa and UNESCO site.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCnGqKDbJimldGzrf1gaY0j7_mtTGXKQRFLQ&s","History"],
["Orchha","Royal palaces and Betwa river beauty.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFN5s7-SKNkzEIr9Wv-EigA0mWuchLnviFCg&s","History"],
["Gwalior","Fort city with rich royal heritage.","https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Gwalior_Fort_front.jpg/960px-Gwalior_Fort_front.jpg","History"],
["Mandu - Jahaz Mahal","Romantic fort city with Afghan architecture.","https://www.mptourism.com/images/point-of-interest/Rewa%20Kund.webp","History"],
["Amarkantak","Origin point of Narmada river.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjrV5-99l7KUwAo_18-qN3v1nOMK12jFMGYA&s","Religious"],

["Chitrakoot","Holy town linked with Lord Ram.","https://www.panna-national-park.com/wp-content/uploads/2019/01/Chitrakoot2.jpg","Religious"],
["Khandwa - Omkareshwar Jyotirlinga","Island Jyotirlinga temple in Narmada river.","https://i0.wp.com/oneday.travel/wp-content/uploads/one-day-indore-to-omkareshwar-jyotirlinga-sightseeing-tour-package-private-car-header.jpg.jpg?fit=1920%2C1280&ssl=1","Religious"],
["Indore ","Food capital and cleanest city of India.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMT37s2Mjuh-ilaeYK0U6mRte2h63-l7pk6g","City"],
["Pench National Park","Tiger reserve shared with Maharashtra.","https://static.wixstatic.com/media/d0f0c8_6fd9bb240252469790120c8afbe70812~mv2.png/v1/fill/w_568,h_758,al_c,q_90,usm_0.66_1.00_0.01,enc_avif,quality_auto/d0f0c8_6fd9bb240252469790120c8afbe70812~mv2.png","Wildlife"],
["Umaria - Bandhavgarh Tiger Reserve","Best tiger spotting national park.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrHDnrWu8Pl5znmQL9zCR-PoUUNofWmd5PQQ&s","Wildlife"],
["Shivpuri - Kuno National Park (Cheetah)","Lakes, forest and Madhav National Park.","https://static.toiimg.com/thumb/msid-94137747,width-400,resizemode-4/94137747.jpg","Nature"],
["Burhanpur - Shahi & Asirgarh Fort","Historic Mughal era city.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZN6Shr0v7crD9iVKDwg7JxCqNLhg6JZEYvA&s","History"],
["Ratlam","Known for sev and trade market.","https://upload.wikimedia.org/wikipedia/commons/0/03/Manglay_mandir_ratlam.png","City"],

["Datia","Peetambara temple and palace famous.","https://static.toiimg.com/photo/108103542.cms","Religious"],
["Maihar - Maa Sharda Devi Temple","Sharda Mata temple hilltop shrine.","https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Sharada_Temple_Maihar.JPG/500px-Sharada_Temple_Maihar.JPG","Religious"],

["Panna Tiger Reserve & Pandav Waterfall","Diamond mines and tiger reserve.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9SZPDmh5xV1GwYH1atBa_O7RnnASdbEkXCw&s","Wildlife"],
["Rewa Fort","fort place.","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMpDzCy13Me8gkK2-6L-TmGaNynxYwROaqRQ&s","Palace"]

];


        foreach($destinations as $dest) {
            echo '
            <div class="card">
                <div class="image-box">
                    <span class="badge">'.$dest[3].'</span>
                    <img src="'.$dest[2].'" alt="'.$dest[0].'">
                </div>
                <div class="card-body">
                    <h4>'.$dest[0].'</h4>
                    <p>Experience the beauty of '.$dest[0].'.</p>
                    <button class="book-btn" onclick="openBooking(\''.$dest[0].'\')">Book Now</button>
                </div>
            </div>';
        }
        ?>
    </div>
</div> 

<section id="support-section" style="padding:60px 5%; background:#fff;">

<h2 style="text-align:center; color:#e67e22; font-size:42px; font-family:Montserrat;">
Support
</h2>

<p style="text-align:center; color:#777; margin-bottom:40px;">
We are here to help you anytime
</p>

<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(420px,1fr)); gap:30px;">

<div style="background:#fff; padding:30px; border-radius:20px; box-shadow:0 5px 20px rgba(0,0,0,0.08);">

<h3>Contact Details</h3>
<p>👤 Abhishek Shrivastava</p>
<p>📞 9479438431</p>
<p>📧 shrivastavaabhishek6677@gmail.com</p>

<a href="tel:9479438431"
style="display:inline-block; margin-top:20px; background:#27ae60; color:#fff; padding:12px 22px; border-radius:10px; text-decoration:none;">
Call Now
</a>

<a href="mailto:shrivastavaabhishek6677@gmail.com"
style="display:inline-block; margin-top:20px; margin-left:10px; background:#e67e22; color:#fff; padding:12px 22px; border-radius:10px; text-decoration:none;">
Email Support
</a>

</div>

<div style="background:#fff; padding:30px; border-radius:20px; box-shadow:0 5px 20px rgba(0,0,0,0.08);">

<h3>Send Your Query</h3>

<input type="text" placeholder="Your Name"
style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:10px;">

<input type="email" placeholder="Your Email"
style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:10px;">

<textarea placeholder="Write your message..."
style="width:100%; height:120px; padding:12px; border:1px solid #ddd; border-radius:10px;"></textarea>

<button onclick="alert('Thank You! We will contact you soon.')"
style="width:100%; background:#e67e22; color:#fff; padding:14px; border:none; border-radius:10px; margin-top:15px;">
Send Message
</button>

</div>

</div>

</section>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeBooking()">&times;</span>
        <h3 id="modalTitle">Book Destination</h3>
        <form action="" method="POST">
            <input type="hidden" name="place" id="placeInput">
            <input type="date" name="travel_date" required>
            <input type="text" name="members" placeholder="Members" min="1" required>
            <button type="submit" name="confirm" class="book-btn">Confirm Reservation</button>
        </form>
    </div>
</div>

<script>
    function openBooking(place) {
        document.getElementById('bookingModal').style.display = 'flex';
        document.getElementById('modalTitle').innerText = "Booking: " + place;
        document.getElementById('placeInput').value = place;
    }
    function closeBooking() {
        document.getElementById('bookingModal').style.display = 'none';
    }
</script>

<?php
// PHP LOGIC UPDATE: Column names ko SQL Table ke hisab se sahi kiya gaya hai
if(isset($_POST['confirm'])) {
    $p = mysqli_real_escape_string($conn, $_POST['place']);
    $d = mysqli_real_escape_string($conn, $_POST['travel_date']);
    $m = mysqli_real_escape_string($conn, $_POST['members']);
    
    // Naya SQL Table ke columns use kar rahe hain
    // 'destination' na ki 'place_name'
    // 'no_of_travelers' na ki 'total_members'
    // 'user_id' add kiya gaya hai
    $sql = "INSERT INTO bookings (user_id, destination, travel_date, no_of_travelers, status) 
            VALUES ('$current_user_id', '$p', '$d', '$m', 'Confirmed')";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking Confirmed for $p!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

</body>
</html>