/**
 * Show the division when it is hidden and vice versa.
 * @param {string} id - The identifier of the division to show or hide.
 */
function toggle(id) {
  if (document.getElementById(id).style.display == "none") {
    document.getElementById(id).style.display = "inline";
  } else {
    document.getElementById(id).style.display = "none";
  }
}
