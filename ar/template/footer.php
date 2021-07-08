
</div>



<script src="./template/js/jquery-3.5.1.js"></script>
<script src="./template/js/bootstrap.js"></script>
<script>
    window.watsonAssistantChatOptions = {
        integrationID: "4d75b4e9-3483-438b-9fbb-87649d0fcf4f", // The ID of this integration.
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