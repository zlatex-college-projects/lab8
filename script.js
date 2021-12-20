const $reportTable = document.querySelector(".reports");
const $loginBtn = document.querySelector(".login-btn");
$reportTable.style.display = "none";

let username = "";
let userID = 0;

$loginBtn.addEventListener("click", async function () {
  const inputValue = document.querySelector("#login").value;
  if (!inputValue) return;
  username = inputValue;

  $reportTable.style.display = "block";
  document.querySelector(".login").style.display = "none";
  document.querySelector(".add-report").style.display = "block";

  const data = await postData("/login.php", {
    login: username,
  });
  userID = data.user_id;
});
async function deleteReport(id) {
  document.querySelector(`.report-${id}`).remove();
  await postData("/delete.php", {
    report_id: id,
  });
}

async function updateReport(id) {
  const $reportTableElement = document.querySelector(`.report-${id}`);

  const name = $reportTableElement.querySelector(".report-name input").value;
  const text = $reportTableElement.querySelector(".report-text textarea").value;

  const res = await postData("/update.php", {
    report_id: id,
    name,
    text,
    user_id: userID,
  });
  if (res) {
    window.location = window.location;
  }
}

document
  .querySelector(".add-report")
  .addEventListener("click", async function () {
    const id = await postData("/create.php", { user_id: userID });
    const $template = /* html */ `
        <div class="report report-${id}">
            <div class="report-id">${id}</div>
            <div class="report-name"><input type="text"></div>
            <div class="report-text"><textarea cols="30" rows="10"></textarea></div>
            <div class="report-author">
                ${username}
            </div>
            <div class="report-save btn"><span>Save</span></div>
            <div class="report-delete btn"><span>Delete</span></div>
        </div>
    `;
    $reportTable.insertAdjacentHTML("beforeend", $template);

    const $newElement = document.querySelector(`.report-${id}`);

    $newElement
      .querySelector(".report-save")
      .addEventListener("click", () => updateReport(id));
    $newElement
      .querySelector(".report-delete")
      .addEventListener("click", () => deleteReport(id));
  });

async function postData(url = "", data = {}) {
  // Default options are marked with *
  const response = await fetch(url, {
    method: "POST", // *GET, POST, PUT, DELETE, etc.
    mode: "cors", // no-cors, *cors, same-origin
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    credentials: "same-origin", // include, *same-origin, omit
    headers: {
      // 'Content-Type': 'application/json'
      "Content-Type": "application/x-www-form-urlencoded",
    },
    redirect: "follow", // manual, *follow, error
    referrerPolicy: "no-referrer", // no-referrer, *client
    body: new URLSearchParams(data), // body data type must match "Content-Type" header
  });
  return await response.json(); // parses JSON response into native JavaScript objects
}
