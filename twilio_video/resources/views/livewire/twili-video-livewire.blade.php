<div>
    {{-- {{$token}} --}}
    <div x-data="{

        search: '',
 
        items: ['foo', 'bar', 'baz'],
 
        get connectToRoom () {

            {{-- const { connect, createLocalVideoTrack } = require('twilio-video'); --}}

            connect( {{$token}}, { name:'cool room' }).then(room => {
                
                console.log(`Successfully joined a Room: ${room}`);

                const videoChatWindow = document.getElementById('video-chat-window');

                createLocalVideoTrack().then(track => {
                    videoChatWindow.appendChild(track.attach());
                });

                room.on('participantConnected', participant => {
                    {{-- console.log(`Participant "${participant.identity}" connected`); --}}

                    participant.tracks.forEach(publication => {
                        if (publication.isSubscribed) {
                            const track = publication.track;
                            videoChatWindow.appendChild(track.attach());
                        }
                    });

                    participant.on('trackSubscribed', track => {
                        videoChatWindow.appendChild(track.attach());
                    });
                });
            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        }

    }">

        <div class="p-5">
            <h1 class="text-2xl mb-4">Laravel Video Chat</h1>
            <div class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black/]">
                <div id="my-video-chat-window"></div>
            </div>
        </div>

    </div>


</div>
