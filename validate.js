/**
 *  requirements to be valid password
 * [1] at least two lowerCase 
 * [2] at least two upperCase
 * [3] at least two special characters
 * [4] at least two numbers
 *  */
function confirmPS(){
  let confPass = document.getElementById("conPass").value;
  let pass = document.getElementById("pass").value;
  if(confPass == ""){
    document.alert("Please Confirm The Password"); // if the browser not support required attribute in input element
    return false;
  }
  if(pass != confPass) {
    alert("Passwords Are Not Identical");
    return false;
  }
  return true;
}

function isSpecialChar(char){ // That Is Collection Of Spectial Characters ASCII code
  if(
    char.charCodeAt(0) >= 33 && char.charCodeAt(0) <= 47 ||
    char.charCodeAt(0) >= 58 && char.charCodeAt(0) <= 64 ||
    char.charCodeAt(0) >= 91 && char.charCodeAt(0) <= 96 ||
    char.charCodeAt(0) >= 123 && char.charCodeAt(0) <= 126
    ) return true;
    else return false;
}

function validatePassword(){ 
  password = document.getElementById("pass").value; 
  let count_lower_cases = 0 ,
  count_upper_case = 0 ,
  count_special_char = 0 ,
  count_nums = 0;
  for(let i = 0 ; i < password.length ; i++){
    if(password[i].charCodeAt(0) >= 97 && password[i].charCodeAt(0) <= 122) count_lower_cases++;
    if(password[i].charCodeAt(0) >= 65 && password[i].charCodeAt(0) <= 90) count_upper_case++;
    if(password[i].charCodeAt(0) >= 48 && password[i].charCodeAt(0) <= 57) count_nums++;
    if(isSpecialChar(password[i])) count_special_char++;
  }

  if(count_lower_cases < 2) {
    let alert = `The Password Must Contain At Least Two Lower Case Caracters`;
    document.getElementById("passAlert").innerHTML = `<span style=\"color:red\">${alert}</span>`;
    return false;
  }
  if(count_upper_case < 2) {
    let alert = `The Password Must Contain At Least Two Upper Case Caracters`;
    document.getElementById("passAlert").innerHTML = `<span style=\"color:red\">${alert}</span>`;
    return false;
  }
  if(count_nums < 2) {
    let alert = `The Password Must Contain At Least Two Numbers`;
    document.getElementById("passAlert").innerHTML = `<span style=\"color:red\">${alert}</span>`;
    return false;
  }
  if(count_special_char < 2) {
    let alert = `The Password Must Contain At Least Two Special Characters`;
    document.getElementById("passAlert").innerHTML = `<span style=\"color:red\">${alert}</span>`;
    return false;
  }
  if(confirmPS()){
    return true;
  }else{
    return false;
  }
}




