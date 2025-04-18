let select_height = document.getElementById("height");
for (let i = 130; i <= 210; i++) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i + " cm";
    select_height.appendChild(option);
}


let select_weight = document.getElementById("weight");
for (let i = 40; i <= 130; i++) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i + " kg";
    select_weight.appendChild(option);
}

let select_shoesize = document.getElementById("shoesize");
for (let i = 17; i <= 50; i+=0.5) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    select_shoesize.appendChild(option);
}






function toggleDropdown(dropdownId) {
    let dropdown = document.getElementById(dropdownId);
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function selectOption(type, option) {
    let input = document.getElementById(`selected${capitalizeFirstLetter(type)}`);
    let hiddenInput = document.getElementById(`${type}Hidden`);

    let selected = input.value ? input.value.split(", ") : [];

    if (!selected.includes(option)) {
        selected.push(option);
    } else {
        selected = selected.filter(s => s !== option);
    }

    const value = selected.join(", ");
    input.value = value;
    hiddenInput.value = value;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

document.addEventListener("click", function(event) {
    let dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        let dropdownList = dropdown.querySelector('.dropdown-content');
        if (!dropdown.contains(event.target)) {
            dropdownList.style.display = "none";
        }
    });
});


