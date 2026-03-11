<?php
ini_set("display_errors", "1");


/*
### Objective

Imagine you work in Smarter Technology’s robotic automation factory, and your objective is to write a 
function for one of its robotic arms that will dispatch the packages to the correct stack according to their volume and mass.

### Rules

Sort the packages using the following criteria:

- A package is **bulky** if its volume (Width x Height x Length) is greater than or equal to 1,000,000 cm³ or when one of its dimensions is greater or equal to 150 cm.
- A package is **heavy** when its mass is greater or equal to 20 kg.

You must dispatch the packages in the following stacks:

- **STANDARD**: standard packages (those that are not bulky or heavy) can be handled normally.
- **SPECIAL**: packages that are either heavy or bulky can't be handled automatically.
- **REJECTED**: packages that are **both** heavy and bulky are rejected.

### Implementation

Implement the function **`sort(width, height, length, mass)`** (units are centimeters for the dimensions and kilogram for the mass). 

This function must return a string: the name of the stack where the package should go.
*/

# Sample Errors
#sortIt("", 0, -1, "xyz");

#Valid Data
echo (sortIt(100, 200, 300, 400));

function displayErrors($arrErrors)
{
    foreach ($arrErrors as $sKey => $sError)
    {
        if ($sKey != "Count")
        {
            echo $sError."<br>";
        }
    }
}   

function sortIt($pWidth, $pHeight, $pLength, $pMass)
{
    $arrReturn = array();

    $arrValues["Description"]["Width"] = $pWidth;
    $arrValues["Description"]["Height"] = $pHeight;
    $arrValues["Description"]["Length"] = $pLength;
    $arrValues["Description"]["Mass"] = $pMass;

    $arrErrors = validateData($arrValues);

    if ($arrErrors["Count"] > 0)
    {
        //Invalid Data
        displayErrors($arrErrors);

        return "";
    }

    //Data is valid from this point on
    $pVolume = $pWidth * $pHeight * $pLength;

    $arrConditions = array();
    if ($pVolume >= 1000000) $arrConditions[] = "Bulky";
    if ($pWidth >= 150 || $pHeight >= 150 || $pLength >= 150) $arrConditions[] = "Bulky";
    if ($pMass >= 20) $arrConditions[] = "Heavy";
    
    $sStack = "STANDARD";
    if (in_array("Bulky", $arrConditions) && in_array("Heavy", $arrConditions))
    {
        $sStack = "REJECTED";
    }
    elseif (in_array("Bulky", $arrConditions) || in_array("Heavy", $arrConditions))
    {
        $sStack = "SPECIAL";
    }

    return $sStack;
}

function validateData($arrInput)
{
    $lErrorCount = 0;
    $arrData = array();

    $arrRules["Required"]["Width"] = 1;
    $arrRules["GreaterThan0"]["Width"] = 1;
    $arrRules["Required"]["Height"] = 1;
    $arrRules["GreaterThan0"]["Height"] = 1;
    $arrRules["Required"]["Length"] = 1;
    $arrRules["GreaterThan0"]["Length"] = 1;
    $arrRules["Required"]["Mass"] = 1;
    $arrRules["GreaterThan0"]["Mass"] = 1;

    $arrReturn["Count"] = 0;
    foreach ($arrRules["Required"] as $sKey => $bRequired)
    {
        if ($bRequired == 1 && (isset($arrInput["Description"][$sKey]) == false || $arrInput["Description"][$sKey] == ""))
        {
            $arrReturn[$arrReturn["Count"]] = $sKey." is required. ";
            $arrReturn["Count"] += 1;
        }
    }

    foreach ($arrRules["GreaterThan0"] as $sKey => $bGreaterThan0)
    {
        if ($bGreaterThan0 == 1 && (isset($arrInput["Description"][$sKey]) == false || is_numeric($arrInput["Description"][$sKey]) == false || $arrInput["Description"][$sKey] <= 0))
        {
            $arrReturn[$arrReturn["Count"]] = $sKey." must be greater than 0. ";
            $arrReturn["Count"] += 1;
        }
    }

    return $arrReturn;
}