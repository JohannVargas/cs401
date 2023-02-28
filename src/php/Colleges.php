<!DOCTYPE html>
<html lang="en">
<style>
  <?php include 'src/css/colleges.css'?>
  <?php include 'src/css/styles.css' ?>
</style>  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>colleges</title>
    <link rel="stylesheet" href="src/css/colleges.css">
    <link rel="stylesheet" href="src/css/styles.css">
    <link rel="stylesheet" href="src/css/footer.css">
</head>
<body>
    <?php include "src/php/nav.php";?>
    <div class="Banner"></div>
    <div class="about">
        <h1 class="welcome_text">WHEN IS MY SPRING BREAK? </h1>

        <p class="welcome_description">Ready to plan your 
            ultimate Spring Break getaway? Look no further than our comprehensive list of colleges and their Spring Break dates! Simply select your college from the list below and we'll show you all the dates you need to know to make the most of your vacation. Whether you're looking to party hard or soak up the sun in a relaxing destination, we've got you covered. So go ahead, start exploring and get ready for the best Spring Break ever!</div>    
            </p>
    </div>
    
    <div class="table-container">
    <h2 class="table-title">SPRING BREAK 2023 DATES</h2>
    <div class="search_bar">
            <input type="text" placeholder="e.g Boise State">
            <button type="submit">Go</button>
            <button class="sort_by">sort by</button>
        </div>
            <table id="collegelistTable">
            <thead class="tablehead">
                <tr>
                    <th>Name of College</th>
                    <th>State</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <tr onclick="window.location='src/php/collegeSite.php';">
                    <td class="university-name">Boise State University</a>
                    <td>Idaho</td>
                    <td>March 20 - March 24</td>
                </tr>
                <tr>
                    <td>University of Florida</td>
                    <td>Florida</td>
                    <td>March 13 - March 17</td>
                </tr>
                <tr>
                    <td>University of California, Los Angeles</td>
                    <td>California</td>
                    <td>March 27 - March 31</td>
                </tr>
                <tr>
                    <td>University of Colorado Boulder</td>
                    <td>Colorado</td>
                    <td>March 13 - March 20</td>
                </tr>
                <tr>
                    <td>University of Hawaii at Manoa</td>
                    <td>Hawaii</td>
                    <td>March 6 - March 12</td>
                </tr>
            </tbody>
        </table>

    </div>
    <?php include "src/php/footer.php"; ?>  
</body>
</html>