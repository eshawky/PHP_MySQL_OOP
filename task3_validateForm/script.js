let age_form  = document.getElementById('age_form');

function validateInputs()
{        

    let valid_age  = false;
    
    if ( age_form.value >= 18)
    {
        document.getElementById('ifvalid_age').innerHTML  = "authorized";
        document.getElementById('ifvalid_age').style.color= "black";

        valid_age = true;

    }else if( age_form.value>0 && age_form.value<18)
    {
        document.getElementById('ifvalid_age').innerHTML  = "un-authorized";
        document.getElementById('ifvalid_age').style.color= "black";
        valid_age = true;

    }else
    {
        document.getElementById('ifvalid_age').innerHTML  = "Please enter a valid age";
        document.getElementById('ifvalid_age').style.color= "red";
        valid_age = false;
    }

    
    //Prevent sign in button from submitting data if not valid
    document.forms[0].onsubmit = function (e)
    {
        if (valid_age === false )
        {
            e.preventDefault(); //prevent submitting here
          
        }else
        {
            //Save age in file in php code

        }
    }

}
