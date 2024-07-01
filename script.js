function toggleExpensesField (){
    var selectFor = document.querySelector("#SelectFor").value;
    var selectExpenses = document.querySelector("#SelectExpenses");

    if(selectFor === "sales"){
        selectExpenses.disabled = true;
    }
    else{
        selectExpenses.s=disabled = false;
    }
}