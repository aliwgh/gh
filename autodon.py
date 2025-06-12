import os
from telethon import TelegramClient, events
from telethon.tl.types import MessageMediaPhoto, MessageMediaDocument

# Replace these with your actual credentials
api_id = 26910017
api_hash = "98830da8a7317e151c4eddc3a9297f03"
session_name = 'cripyq'

# Replace with the target channel ID or username
target_channel = -1002236561307  # Use the full channel ID with -100 prefix for private channels

bot = TelegramClient(session_name, api_id, api_hash)

@bot.on(events.NewMessage(func=lambda event: event.media and hasattr(event.media, 'ttl_seconds')))
async def autodownload_selfdestructive(event):
    try:
        # Get the bot's user ID
        me = await bot.get_me()
        bot_user_id = me.id

        # Only process messages sent by others, not the bot itself
        if event.sender_id != bot_user_id:
            if isinstance(event.media, (MessageMediaPhoto, MessageMediaDocument)) and event.media.ttl_seconds:
                # Download media
                download = await bot.download_media(event.media)

                # Send the media first
                await bot.send_file(target_channel, download)

                # Send the "Saved ✓" message after the media
                await bot.send_message(target_channel, "Saved ✓")

                # Remove the downloaded file
                os.remove(download)
    except Exception as e:
        # Send error details to your personal "Saved Messages" chat
        await bot.send_message('me', f"Error: {e}")

# Start the bot and keep it running
bot.start()
bot.run_until_disconnected()
