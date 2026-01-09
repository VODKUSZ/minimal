async function sendTodo() {
  const input = document.getElementById("task");
  const task = input.value;

  try {
    const res = await fetch("insert.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ task, finished: false })
    });

    if (!res.ok) {
      throw new Error("HTTP hiba: " + res.status);
    }

    const data = await res.json();

    document.getElementById("result").textContent =
      JSON.stringify(data, null, 2);

    input.value = "";
  } catch (err) {
    document.getElementById("result").textContent =
      "Hiba: " + err.message;
  }
}
