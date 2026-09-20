async function fetchData(url, delaySimulation = 3000) {
  const tbody = document.querySelector(".table-responsive table tbody");
  const loading = document.getElementById("loading-indicator");

  if (!tbody) return;

  loading.style.display = "block";
  tbody.innerHTML = "";

  try {
    await new Promise((resolve) => setTimeout(resolve, delaySimulation));
    const res = await fetch(url);

    if (!res.ok) throw new Error("Gagal mengambil data (status " + res.status + ")");

    const dataList = await res.json();

    dataList.forEach(function (item) {
		const tr = document.createElement("tr");

		let htmlString = "";
		Object.values(item).forEach(function (value) {;
			htmlString += "<td>" + (value ?? "") + "</td>";
		});

		htmlString += "<td>" +
        "<button type=\"button\">Edit</button> " +
        "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
        "</td>";

		tr.innerHTML = htmlString;

		tbody.appendChild(tr);
	});
  } catch (err) {
    tbody.innerHTML =
      '<tr><td colspan="5">Gagal memuat data: ' + err.message + "</td></tr>";
  } finally {
    loading.style.display = "none";
  }
}
