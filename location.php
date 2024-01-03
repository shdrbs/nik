<script>
    var host = location.host;
    console.log(host); // localhost

    var hostname = location.hostname;
    console.log(hostname); // localhost

    var href = location.href;
    console.log(href); // http://localhost/location.php?dd=1

    var origin = location.origin;
    console.log(origin); // http://localhost

    var pathname = location.pathname;
    console.log(pathname); // /location.php

    var port = location.port;
    console.log(port); //

    var protocol = location.protocol;
    console.log(protocol); // http:

    var search = location.search;
    console.log(search); // ?dd=1

    const searchParams = new URLSearchParams(location.search);
    for (const param of searchParams){
        console.log(param);
    }

    const urlParams = new URL(location.href).searchParams;
    const name = urlParams.get('dd');
    console.log(name);
</script>