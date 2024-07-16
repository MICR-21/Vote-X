<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="logassets/css/bootstrap.min.css" rel="stylesheet">
    <link href="logassets/css/font-awesome.min.css" rel="stylesheet">
    <link href="logassets/css/style.css" rel="stylesheet">

    <title>Form</title>
    <script>
        // Include this script in your blade view or your frontend script
        async function connectMetaMask() {
            alert("meta connect?");
            if (typeof window.ethereum !== 'undefined') {
                try {
                    // Request account access
                    const accounts = await ethereum.request({
                        method: 'eth_requestAccounts'
                    });
                    const account = accounts[0]; // Get the first account

                    // Now you can send this account address to your backend
                    document.getElementById('voter_id').value = account;
                    alert("Voter ID collected. You can now continue.");
                } catch (error) {
                    console.error('User denied account access or error occurred:', error);
                }
            } else {
                alert('MetaMask is not installed. Please install it to use this feature.');
            }
        }

        // Function to validate if voter ID is collected
        function validateForm() {
            const voterId = document.getElementById('voter_id').value;
            if (!voterId) {
                alert("Please connect to MetaMask to collect your voter ID before submitting the form.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <section class="form-08">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="_form-08-main">
                        <div class="_form-08-head">
                            <h2>Vote_X Register</h2>
                        </div>
                        <!-- Add this HTML where you need the MetaMask button and hidden input -->
                        <button id="connectButton" onclick="connectMetaMask()" class="_btn_04">Connect MetaMask</button>

                        <form action="{{ url('register') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            @include('message')

                            <input type="hidden" id="voter_id" name="voter_id" required>

                            <div class="form-group">
                                <label>Enter Your Username</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                            </div>

                            <div class="form-group">
                                <label>Enter Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                            </div>

                            <div class="checkbox mb-0 form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="">
                                        <a href="{{ url('/') }}">Back to Login</a>
                                    </label>
                                </div>
                                <a href="#">Forgot Password</a>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="_btn_04">Create account</button>
                            </div>
                        </form>

                        <div class="sub-01">
                            <img src="logassets/images/shap-02.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
