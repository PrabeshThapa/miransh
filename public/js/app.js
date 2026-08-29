function setLanguage(language) {

    document.body.classList.remove("en", "ja");

    document.body.classList.add(language);

    const enBtn = document.getElementById("enBtn");
    const jaBtn = document.getElementById("jaBtn");

    enBtn.classList.remove("active");
    jaBtn.classList.remove("active");

    if (language === "en") {

        enBtn.classList.add("active");

        document.documentElement.lang = "en";

        document.title =
            "MIRANSH LLC | International Human Resources & Student Support";

    } else {

        jaBtn.classList.add("active");

        document.documentElement.lang = "ja";

        document.title =
            "ミランス合同会社 | 国際人材紹介・留学生紹介";
    }

    localStorage.setItem(
        "miransh_language",
        language
    );
}


document.addEventListener(
    "DOMContentLoaded",
    function () {

        const savedLanguage =
            localStorage.getItem("miransh_language");

        if (savedLanguage === "ja") {
            setLanguage("ja");
        } else {
            setLanguage("en");
        }

    }
);
