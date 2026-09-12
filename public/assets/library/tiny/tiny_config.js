const options = {
    init_instance_callback: function (editor) {
        var freeTiny = document.querySelectorAll(".tox .tox-notification--in");
        freeTiny.forEach((item) => {
            item.style.display = "none";
        });
    },
    directionality: "rtl",
    language: "fa",
    branding: false,
    force_br_newlines: true,
    convert_newlines_to_brs: true,
    plugins: ["anchor", "fullscreen", "table", "lists"],
    toolbar:
        "undo redo | formatselect | " +
        "bold italic backcolor | alignleft aligncenter " +
        "alignright alignjustify | bullist numlist outdent indent | " +
        "table |" +
        "numlist bullist",
    content_style:
        "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
};
export default options;
