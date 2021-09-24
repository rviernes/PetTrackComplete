<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Pet Information</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="card">
          <div class="card-header">
              <div class="col">
                  <div class="card-bod">
                    <table class="table" >
                        <thead>
                          <tr>
                            <th width="10%" scope="col">#</th>
                            <th scope="col">Info</th>

                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">Name:</th>
                            <td>{{ $QrCodeDatas->pet_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Gender:</th>
                            <td>{{ $QrCodeDatas->pet_gender }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Birthday:</th>
                            <td>{{ $QrCodeDatas->pet_birthday }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Bloodtype:</th>
                            <td>{{ $QrCodeDatas->pet_bloodType }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Date Registered:</th>
                            <td>{{ $QrCodeDatas->pet_registeredDate }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Pet Type:</th>
                            <td>{{ $QrCodeDatas->type_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Pet Breed:</th>
                            <td>{{ $QrCodeDatas->breed_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Owner:</th>
                            <td>{{ $QrCodeDatas->customer_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Address:</th>
                            <td>{{ $QrCodeDatas->customer_address }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Clinic:</th>
                            <td>{{ $QrCodeDatas->clinic_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Status:</th>
                            @if ($QrCodeDatas->pet_isActive == 1)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif
                            
                          </tr>
                          
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </div>
    

   
</body>
</html>

