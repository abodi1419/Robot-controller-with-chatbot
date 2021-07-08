
</div>



<script src="./template/js/jquery-3.5.1.js"></script>
<script src="./template/js/bootstrap.bundle.js"></script>
<script>

    window.watsonAssistantChatOptions = {
        integrationID: "db6c311c-36fe-4afb-8a0f-310dc9aeb5ba", // The ID of this integration.
        region: "us-south", // The region your integration is hosted in.
        serviceInstanceID: "242ce836-223e-4e52-9a48-42deebb7e59b", // The ID of your service instance.
        onLoad: function(instance) { instance.render(); }
    };
    setTimeout(function(){
        const t=document.createElement('script');
        t.src="https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js";
        document.head.appendChild(t);
    });
</script>
</body>
</html>