The file smarter.php represents my solution to the problem using PHP.

I have provided 2 examples that can be commented/uncommented out:

# Sample Errors
#sortIt("", 0, -1, "xyz");

#Valid Data
echo (sortIt(100, 200, 300, 400));

The Sample Error version returns an array of data to a handler that currently just outputs the Error Text. Generally it would log the errors and redirect or return back data that can be displayed on the page. 

The validateData function does all of the validation and allows various error condition checks to be made:

For instance:
    $arrRules["Required"]["Width"] = 1;
    $arrRules["GreaterThan0"]["Width"] = 1;

Currently, there are 2 Error Condition Rules
1) Value is Required
2) Value must be Numeric and Greater than 0

Additional Error conditions can easily be added here as required.

Function returns a single string with the condition. Alternatively it can be easily be returned in json format using json_encode or as an array of data.
