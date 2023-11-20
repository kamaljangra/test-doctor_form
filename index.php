<?php
$conn = new mysqli('localhost', 'root', '', 'test');

$doctypeSelected = $_GET['doc_type'] ?? "MBBS";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>doc</title>
    <style>
        #doctorForm {
            border: 1px solid;
            width: 200px;
            padding: 20px;
        }

        input {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form id="doctorForm" method="post" enctype="multipart/form-data">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required><br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" name="phoneNumber" id="phoneNumber" required><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="radio" name="gender" value="Other" required> Other<br>

        <label for="docType">Doc Type:</label>
        <select name="docType" id="docType" required>
            <option value="MBBS">MBBS</option>
            <option value="MD">MD</option>
            <option value="Other">Other</option>
        </select><br>

        <label for="skills">Skills:</label>
        <select name="skills[]" id="skills" multiple>
            <option value="Skill1">Skill 1</option>
            <option value="Skill2">Skill 2</option>
            <option value="Skill3">Skill 3</option>
            <!-- Add more skills here -->
        </select><br>

        <label>Qualifications :</label><br>
        <input type="checkbox" name="qualifications[]" value="10th"> 10th
        <input type="checkbox" name="qualifications[]" value="12th"> 12th
        <input type="checkbox" name="qualifications[]" value="Bachelor"> Bachelor
        <input type="checkbox" name="qualifications[]" value="Master"> Master<br>

        <label for="myfile">Select a file:</label>
        <input type="file" id="myfile" name="myfile"><br><br>

        <input type="submit" value="Submit">
    </form>


    <!-- --------------------- show doctor------------------------ -->
    <form id="tableForm" method="GET" style="margin-top: 50px;">
        <select name="doc_type" id="doc_type">
            <option selected><?php echo $doctypeSelected ?></option>
            <option value="MBBS">MBBS</option>
            <option value="MD">MD</option>
            <option value="Other">Other</option>
        </select>
        <input type="submit" value="Search">
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Doc Type</th>
            <th>Gender</th>
            <th>Skills</th>
            <th>Qualifications</th>
            <th>Profile Image</th>
            <th>Action</th>
        </tr>
        <tbody>
            <?php
            $query = "SELECT * FROM doc WHERE doctype='$doctypeSelected'";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
                echo "
                <tr id='rowno$row[id]'>
                    <td>$row[id]</td>
                    <td>$row[FName]</td>
                    <td>$row[LName]</td>
                    <td>$row[Email]</td>
                    <td>$row[phone]</td>
                    <td>$row[doctype]</td>
                    <td>$row[gender]</td>
                    <td>$row[skills]</td>
                    <td>$row[qualifications]</td>
                    <td><img src='$row[profile_image]' width='100'></td>
                    <td><a onclick='deleteDoc($row[id])'>delete</a></td>
                </tr>
            ";
            }
            ?>
        </tbody>
    </table>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#doctorForm").submit(function() {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });


        function deleteDoc(id) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    delete: true,
                    docID: id
                },
                success: function(result) {
                    console.log(result);
                    $('#rowno' + id).remove();
                },

            });
        }
    </script>
</body>

</html>