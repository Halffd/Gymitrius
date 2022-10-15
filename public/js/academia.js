/*const mysql = require('mysql'); // or use import if you use TS
const util = require('util');
const conn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "root",
    port : 3306,
    database: "academias"
});
const puppeteer = require("puppeteer")
const query = util.promisify(conn.query).bind(conn);

$(document).ready(function () {
    console.log("Start")
    (async () => {
        try {
        console.log("Querying")
        conn.connect()
        const rows = await query('select count(*) as count from academia');
        console.log(rows);
        } finally {
        conn.end();
        }
    })()
});

document
  .getElementById("getWeather")
  .addEventListener("click", () => {
    handleGetWeather();
  });

async function handleGetWeather() {
    (async () => {
        try {
        console.log("Querying")
        conn.connect()
        const rows = await query('select count(*) as count from academia');
        console.log(rows);
        } finally {
        conn.end();
        }
    })()
}
/*
async function currentWeather(location, apiKey) {
  const city = location.replace(/\s\s+/g, ' '); // Replace multiple spaces with single space
  if (city === "" || city === " ") return `<pre>Please enter a location!</pre>`;
  let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=imperial&appid=${apiKey}`;
  try {
    const res = await fetch(url);
    if (res.ok === false) {
      return `<pre><i>Location '${encodeURIComponent(city)}' not found!</i></pre><br/><pre>Full Error: ${res.statusText}</pre>`;
    }
    const weather = await res.json();
    const main = weather.main;
    const t = Number(main.temp) >= 71.00 ? 'hot' : 'cold';
    const min = Number(main.temp_min) >= 71.00 ? 'hot' : 'cold';
    const max = Number(main.temp_max) >= 71.00 ? 'hot' : 'cold';
    return `
      <h1>
        It's <span class="${t}">${main.temp}</span> degrees in ${weather.name}!
      </h1>
      <h1>
        The low for today will be 
        <span class="${min}">${main.temp_min}</span>
        degrees with a high of 
        <span class="${max}">${main.temp_max}</span>
      </h1>
    `;
  } catch {
    return `<pre><i>Error, please try again.</i></pre>`;
  }
}*/