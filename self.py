##@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq








import os
os.system('pip install  telethon && pip install  requests && pip install  asyncio && pip install  aiocron && pip install  pytz && pip install  googletrans==4.0.0-rc1 && pip install  gtts && pip install  psutil && pip install  jdatetime && clear')
from telethon.tl.functions.channels import EditBannedRequest
from telethon.tl.functions.channels import EditBannedRequest
from telethon.tl.functions.channels import GetParticipantsRequest
from telethon.tl.types import ChatBannedRights



from telethon import TelegramClient, events
import asyncio
from datetime import datetime, timedelta
from telethon.errors.rpcerrorlist import MessageNotModifiedError
from datetime import datetime, timedelta
from telethon import events, functions
from telethon.errors.rpcerrorlist import ChatAdminRequiredError
from telethon.tl.types import User
from telethon import events, functions, types
import time
from telethon.errors.rpcerrorlist import MessageNotModifiedError
import aiohttp
from telethon.sync import TelegramClient,events
from telethon.errors import FloodWaitError
from telethon import TelegramClient,functions,utils,types
from telethon.tl.functions.users import GetFullUserRequest
from telethon.tl.types import ChannelParticipantsAdmins
from telethon.tl.custom import Dialog
from telethon.tl import types
from telethon.tl.types import Channel, Chat, User
from googletrans import Translator
#from gtts import gTTS
from telethon.sync import TelegramClient,events
from telethon.errors import FloodWaitError
from telethon import TelegramClient,functions,utils,types
from telethon.tl.functions.users import GetFullUserRequest
from telethon.tl.custom import Dialog
from telethon.tl import types
from telethon.tl.types import Channel, Chat, User
from googletrans import Translator
#from gtts import gTTS
from datetime import datetime , timedelta
import random
import psutil
import json
import pytz
import aiocron
import asyncio
#import requests
import jdatetime

def get(file):
    with open(file,"r") as r:
        return json.load(r)

def put(file,data):
    with open(file,"w") as w:
        json.dump(data,w)

def timeDif(get):
    match = str(datetime.strptime(get.replace('+00:00', ''), '%Y-%m-%d %H:%M:%S')).split(' ')
    date = match[0].split('-')
    time = match[1].split(':')
    delta = timedelta(
    days = int(date[2]),
    hours = int(time[0]),
    minutes = int(time[1]),
    seconds = int(time[2]),
    )
    return int(delta.total_seconds())


##@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq


def randomphoto():
    name = random.choice(os.listdir("photo"))
    return f"photo\{name}"


if not "data.json" in os.listdir():
        data = {"timename":"off","timebio":"off","timeprof":"off","bot":"on","hashtag":"off","bold":"off","italic":"off","delete":"off","code":"off","underline":"off","reverse":"off","part":"off","mention":"off","typing":"off","game":"off","voice":"off","video":"off","sticker":"off"}
        put("data.json",data)

api_id = 26910017####
api_hash = "98830da8a7317e151c4eddc3a9297f03"##
session_name = 'cripyq'

bot = TelegramClient(session_name, api_id, api_hash)



@aiocron.crontab('*/1 * * * *')
async def clock():
    js = get("data.json")
    if js['timename'] == "off" and js['timebio'] == "off" and js['timeprof'] == "off":
        pass
    ir = pytz.timezone("Asia/Tehran")
    current_time = jdatetime.datetime.now(ir).strftime("%H:%M")
    current_time = current_time.replace('0', '𝟶').replace('1', '𝟷').replace('2', '𝟸').replace('3', '𝟹').replace('4', '𝟺').replace('5', '𝟻').replace('6', '𝟼').replace('7', '𝟽').replace('8', '𝟾').replace('9', '𝟿')
    if js['timename'] == "on":
        await bot(functions.account.UpdateProfileRequest(last_name=current_time))
    if js['timebio'] == "on":
        bio = "[{}] Join @fent4nil".format(current_time)
        await bot(functions.account.UpdateProfileRequest(about=bio))
   






@bot.on(events.NewMessage())
async def updateAction(event):
    js = get("data.json")
    for type in ["typing","game","voice","video","sticker"]:
        if js[type] == "on":
            async with bot.action(event.chat_id,type):
                await asyncio.sleep(2)
                
         
    
 

                

#gp



@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'ban'))
async def ban_user(event):
    if event.is_private:  # Ensure it's not a private chat
        return

    chat = await event.get_chat()
    if not chat.admin_rights.ban_users:  # Check if bot has ban rights
        await event.edit("I don't have permission to ban users in this group.")
        return

    if event.is_group and event.is_reply:
        replied_msg = await event.get_reply_message()
        user_to_ban = replied_msg.sender_id

        await bot(EditBannedRequest(event.chat_id, user_to_ban, banned_rights=ChatBannedRights(until_date=None, view_messages=True)))
        await event.edit("user banned ✓")
    else:
        await event.edit("Please reply to the user you want to ban.")

@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'unban'))
async def unban_user(event):
    if event.is_private:  # Ensure it's not a private chat
        return

    chat = await event.get_chat()
    if not chat.admin_rights.ban_users:  # Check if bot has ban rights
        await event.edit("I don't have permission to unban users in this group.")
        return

    if event.is_group and event.is_reply:
        replied_msg = await event.get_reply_message()
        user_to_unban = replied_msg.sender_id

        await bot(EditBannedRequest(event.chat_id, user_to_unban, banned_rights=ChatBannedRights(until_date=None, view_messages=False)))
        await event.edit("user unbanned ✓")
    else:
        await event.edit("Please reply to the user you want to unban.")








@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'mute'))
async def mute_user(event):
    # Check if the message is a reply
    if event.is_reply:
        # Get the replied message
        replied_msg = await event.get_reply_message()
        # Mute the user who sent the replied message
        if replied_msg.sender_id:
            await event.client.edit_permissions(event.chat_id, replied_msg.sender_id, send_messages=False)
            await event.edit("user muted ✓")
        else:
            await event.edit("Cannot determine user ID.")
    elif event.message.mentioned:
        for user in event.message.mentioned:
            await event.client.edit_permissions(event.chat_id, user.user_id, send_messages=False)
            await event.respond("muted ✓")
    else:
        await event.edit("Please reply to the user's message or mention the user you want to mute.")

# Function for unmuting a user
@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'unmute'))
async def unmute_user(event):
    # Check if the message is a reply
    if event.is_reply:
        # Get the replied message
        replied_msg = await event.get_reply_message()
        # Unmute the user who sent the replied message
        if replied_msg.sender_id:
            await event.client.edit_permissions(event.chat_id, replied_msg.sender_id, send_messages=True)
            await event.edit("user unmuted ✓")
        else:
            await event.edit("Cannot determine user ID.")
    elif event.message.mentioned:
        for user in event.message.mentioned:
            await event.client.edit_permissions(event.chat_id, user.user_id, send_messages=True)
            await event.respond("umuted ✓")
    else:
        await event.edit("Please reply to the user's message or mention the user you want to unmute.")
        


    
    
 #panel


@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'panel'))
async def panel_info(event):


    # Remove the command message after being sent
    await event.delete()

    # Assuming get() is a function for retrieving data from JSON
    results = await bot.inline_query('pyrohelpbot', 'Helper')
    await results[0].click(event.chat_id)

# Start the bot


   


##@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq

                
@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'block'))
async def block_user(event):
    replied_msg = await event.get_reply_message()  # Get the replied message
    if replied_msg:  # Check if there is a replied message
        user_id = replied_msg.sender_id
        try:
            await bot(functions.contacts.BlockRequest(user_id))
            await event.edit('blocked ✓')
        except Exception as e:
            await event.respond(message)
            
            
            
    



  
            
            #id
            
            
        

@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'id'))
async def handler(event):
    if event.is_private:
        if event.is_reply:
            replied_msg = await event.get_reply_message()
            if replied_msg.sender_id is None:
                await event.edit("User not found.")
                return

            user_id = replied_msg.sender_id
            await event.edit(f"id : {user_id}")
        else:
            await event.edit(f"id : {event.sender_id}")
    elif event.is_reply:
        replied_msg = await event.get_reply_message()
        if replied_msg.sender_id is None:
            await event.edit("User not found.")
            return

        chat_id = replied_msg.sender_id
        try:
            info = await bot.get_entity(chat_id)
        except ValueError:
            await event.edit("User not found.")
            return

        msg = (
            f"id : {info.id}\n"
        )
        await event.edit(msg)
    else:
        await event.edit("id : {}".format(event.sender_id))




    





    

    
    
    
    

      #file to link
     




# Assuming you have already created and authenticated a TelegramClient instance

@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'upload'))
async def upload_file(event):
    # Send a "Please wait" message with edit method
    await event.edit("downlod in progress ✓")
    
    if event.reply_to_msg_id:
        reply_message = await event.get_reply_message()
        if reply_message.file:
            file_path = await bot.download_media(reply_message)
            await event.edit("upload in progress ✓")
            async with aiohttp.ClientSession() as session:
                async with session.post("https://file.io", data={'file': open(file_path, 'rb')}) as response:
                    uploaded_file_data = await response.json()
                    if 'link' in uploaded_file_data and uploaded_file_data['link']:
                        uploaded_file_link = uploaded_file_data['link']
                        
                        # Delete the command message
                        await event.delete()
                        
                        # Send a caption for the uploaded file
                        await reply_message.reply(f"uploaded. link : {uploaded_file_link}")
                    else:
                        await event.respond(message)


                        


                    

                    
                    
    
    #url don


MAX_FILE_SIZE_MB = 100  # Maximum file size allowed in megabytes

@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'don'))
async def download_and_send_file(event):
    async with bot.action(event.chat_id, "typing"):
        command_parts = event.raw_text.split(' ')
        if len(command_parts) < 2:
            await event.respond("Please provide a valid URL after the 'don' command.")
            return
        url = command_parts[1]  # Get the URL provided after the 'don' command
        async with aiohttp.ClientSession() as session:
            async with session.head(url) as resp:
                content_length = resp.headers.get('Content-Length')
                if content_length is None:
                    await event.respond("Unable to determine file size.")
                    return
                file_size_mb = int(content_length) / (1024 * 1024)  # Convert bytes to megabytes
                if file_size_mb > MAX_FILE_SIZE_MB:
                    await event.respond(f"Sorry, the file exceeds the maximum allowed size of {MAX_FILE_SIZE_MB} MB.")
                    return

        filename = url.split('/')[-1]  # Extract filename from URL
        async with aiohttp.ClientSession() as session:
            async with session.get(url) as resp:
                if resp.status == 200:
                    total_size = int(resp.headers.get('Content-Length', 0))
                    downloaded = 0
                    with open(filename, 'wb') as f:
                        async for data in resp.content.iter_any():
                            f.write(data)
                            downloaded += len(data)
                            percent = int((downloaded / total_size) * 100)
                            download_message = f"download in progress ✓\n\nstatus : {percent}%"
                            try:
                                await event.edit(download_message)
                            except MessageNotModifiedError:
                                pass
                            if downloaded >= total_size:
                                await event.edit("just a sec...")
                                upload_message = await event.respond("upload in progress ✓")
                                await event.respond(file=filename)  # Sends the file back to the same chat after completion
                                await event.respond("operation completed ✓")  # Send a separate message with the caption
                                await bot.delete_messages(event.chat_id, [upload_message.id, event.id])  # Delete both upload_message and the command message
                                break


##@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq


#ping


@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'ping'))
async def get_server_ping(event):
    if event.sender_id == 1866530036 :
        start = time.time()
        await event.edit("pinging in progress ✓")
        end = time.time()
        duration = (end - start) * 1000  # Convert to milliseconds
        await event.edit(f"ping : {duration:.2f}ms")




##@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq@cripyq


#clone
from telethon import events, functions

@bot.on(events.NewMessage(func=lambda event: event.text.lower() == 'clone'))
async def clone_profile(event):
    # Get the message sender's ID
    sender_id = event.sender_id
    
    # Get the IDs of the users in the current chat
    async for user in event.client.iter_participants(event.chat_id):
        if user.id != sender_id:
            try:
                # Download profile picture of the user
                photo = await event.client.download_profile_photo(user)
                
                # Set downloaded profile picture as admin's profile picture
                await event.client(functions.photos.UploadProfilePhotoRequest(
                    file=await event.client.upload_file(photo)
                ))
                
                # Add a line for admin ID
                await event.respond(f"{user.id}'s profile picture has been set successfully ✓")
                break  # Stop after cloning the first profile picture
            except Exception as e:
                await event.respond(message)
                break
                
                














                                







@bot.on(events.NewMessage(pattern=r'dice (1|2|3|4|5|6)', outgoing=True))
async def dice(event):
    if event.fwd_from:
        return
    input_str = event.pattern_match.group(1)
    await event.delete()
    send = await bot.send_file(event.chat_id, types.InputMediaDice('🎲'))
    while(send.media.value != int(input_str)):
        await bot.delete_messages(event.chat_id,send.id)
        send = await bot.send_file(event.chat_id, types.InputMediaDice('🎲'))

@bot.on(events.NewMessage(pattern=r'reaction (.*)', outgoing=True))
async def reaction(event):
    if event.fwd_from:
        return
    input_str = event.pattern_match.group(1)
    if input_str in "love":
        emoticons = ["🤍","🖤","💜","💙","💚","💛","🧡","❤️","🤎","💖"]
    elif input_str in "oclock":
        emoticons = ["🕐","🕑","🕒","🕓","🕔","🕕","🕖","🕗","🕘","🕙","🕚","🕛","🕜","🕝","🕞","🕟","🕠","🕡","🕢","🕣","🕤","🕥","🕦","🕧"]
    elif input_str in "star":
        emoticons = ["💥","⚡️","✨","🌟","⭐️","💫"]
    elif input_str in "snow":
        emoticons = ["❄️","☃️","⛄️"]		
    for i in range(10):
        await asyncio.sleep(0.5)
        await event.edit(random.choice(emoticons))

@bot.on(events.NewMessage(pattern=r'(heart|قلب)', outgoing=True))
async def heart(event):
    if event.fwd_from:
        return
    for x in range(1,4):
        for i in range(1,11):
            txt = "➣ " + str(x) + " ❦" * i + " | " + str(10 * i) + "%"
            await event.edit(txt)

@bot.on(events.NewMessage(pattern=r'clean (.*)', outgoing=True))
async def clean(event):
    if event.fwd_from:
        return
    input_str = event.pattern_match.group(1)
    message_id = event.message.id
    for i in range(int(input_str)):
        await bot.delete_messages(event.chat_id,message_id)
        message_id -= 1
    await bot.send_message(event.chat_id,f"پاک شد.")

@bot.on(events.NewMessage(pattern=r'timename (on|off)', outgoing=True))
async def timename(event):
    if event.fwd_from:
        return
    input_str = event.pattern_match.group(1)
    js = get("data.json")
    js["timename"] = str(input_str)
    put("data.json",js)
    await event.edit(f"𝗦𝘁𝗮𝘁𝘂𝘀: {input_str}")


@bot.on(events.NewMessage(pattern=r'timebio (on|off)', outgoing=True))
async def timebio(event):
    if event.fwd_from:
        return
    input_str = event.pattern_match.group(1)
    js = get("data.json")
    js["timebio"] = str(input_str)
    put("data.json",js)
    await event.edit(f"𝗦𝘁𝗮𝘁𝘂𝘀: {input_str}")


@bot.on(events.NewMessage(pattern=r'tagall', outgoing=True , func=lambda e: e.is_group))
async def tagall(event):
    if event.fwd_from:
        return
    mentions = "tagged"
    chat = await event.get_input_chat()
    async for x in bot.iter_participants(chat, 100):
        mentions += f" \n [{x.first_name}](tg://user?id={x.id})"
    await event.reply(mentions)
    await event.delete()
    
@bot.on(events.NewMessage(pattern=r'tagadmins', outgoing=True , func=lambda e: e.is_group))
async def tagadmins(event):
    if event.fwd_from:
        return
    mentions = "tagged"
    chat = await event.get_input_chat()
    async for x in bot.iter_participants(chat, filter = ChannelParticipantsAdmins):
        mentions += f" \n [{x.first_name}](tg://user?id={x.id})"
    await event.reply(mentions)
    await event.delete()



    

@bot.on(events.NewMessage(pattern=r'status', outgoing=True))
async def status(event):
    if event.fwd_from:
        return
    private_chats = 0
    bots = 0
    groups = 0
    broadcast_channels = 0
    admin_in_groups = 0
    creator_in_groups = 0
    admin_in_broadcast_channels = 0
    creator_in_channels = 0
    unread_mentions = 0
    unread = 0
    largest_group_member_count = 0
    largest_group_with_admin = 0
    dialog: Dialog
    async for dialog in bot.iter_dialogs():
        entity = dialog.entity
        if isinstance(entity, Channel):
            if entity.broadcast:
                broadcast_channels += 1
                if entity.creator or entity.admin_rights:
                    admin_in_broadcast_channels += 1
                if entity.creator:
                    creator_in_channels += 1
            elif entity.megagroup:
                groups += 1
                if entity.creator or entity.admin_rights:
                    admin_in_groups += 1
                if entity.creator:
                    creator_in_groups += 1
        elif isinstance(entity, User):
            private_chats += 1
            if entity.bot:
                bots += 1
        elif isinstance(entity, Chat):
            groups += 1
            if entity.creator or entity.admin_rights:
                admin_in_groups += 1
            if entity.creator:
                creator_in_groups += 1
        unread_mentions += dialog.unread_mentions_count
        unread += dialog.unread_count
    txt = f"┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄\ncheck it👇 :"
    txt += f"\npv : {private_chats}"
    txt += f"\nbot : {bots}"
    txt += f"\mgroups : {groups}"
    txt += f"\nchannel : {broadcast_channels}"
    txt += f"\nunread : {unread}\n┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄"
    await event.edit(txt)

@bot.on(events.NewMessage(pattern=r'sessions', outgoing=True))
async def session(event):
    if event.fwd_from:
        return
    result = await bot(functions.account.GetAuthorizationsRequest())
    txt = f"┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄\ncheck it 👇 :\n\n"
    for i in result.authorizations:
        txt += f"hash : {i.hash}\ndevice model : {i.device_model}\nplatform : {i.platform}\nsys version : {i.system_version}\napi id : {i.api_id}\napp name : {i.app_name}\napp version : {i.app_version}\ndate created : {i.date_created}\ndate active : {i.date_active}\nip : {i.ip}\ncountry : {i.country}\n┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄┄┅┈┉┅┉┈┅┄\n"
    await event.edit(txt)

@bot.on(events.NewMessage(pattern=r'translate', outgoing=True , func=lambda e: e.is_reply))
async def translate(event):
    if event.fwd_from:
        return
    match = event.raw_text.split(' ')
    if len(match) == 2:
        lan = str(match[1])
    else:
        lan = "fa"
    getMessage = await event.get_reply_message()
    message = getMessage.raw_text
    try:
        translate = Translator().translate(message,lan)
        src = translate.src
        dest = translate.dest
        text = translate.text
        await event.edit(f"done ✓ :\n\n{text}")
    except Exception as e:
        await bot.send_message('me', f"error!")





#auto don

@bot.on(events.NewMessage(func=lambda event: event.media and hasattr(event.media, 'ttl_seconds')))
async def autodownload_selfdestructive(event):
    try:
        if isinstance(event.media, types.MessageMediaPhoto) and event.media.ttl_seconds:
            download = await bot.download_media(event.media)
            await bot.send_message('me', 'image saved ✓', file=download)
            os.remove(download)
      
    except Exception as e:
        await event.respond(message)







        





@bot.on(events.NewMessage(outgoing=True))
async def mode(event):
    if event.fwd_from:
        return
    js = get("data.json")
    text = event.raw_text
    if js['hashtag'] == "on":
        new = text.replace(" ","_")
        await event.edit(f"#{new}")
    elif js['bold'] == "on":
        await event.edit(f"<b>{text}</b>", parse_mode = "HTML")
    elif js['italic'] == "on":
        await event.edit(f"<i>{text}</i>", parse_mode = "HTML")
    elif js['delete'] == "on":
        await event.edit(f"<del>{text}</del>", parse_mode = "HTML")
    elif js['code'] == "on":
        await event.edit(f"<code>{text}</code>", parse_mode = "HTML")
    elif js['underline'] == "on":
        await event.edit(f"<u>{text}</u>", parse_mode = "HTML")
    elif js['reverse'] == "on":
        await event.edit(text[::-1], parse_mode = "HTML")
    elif js['part'] == "on":
        if len(text) > 1:
            new = ""
            for add in text:
                new += add
                if add != " ":
                    await event.edit(new, parse_mode = "HTML")
    elif js['mention'] == "on":
        if event.is_reply:
            try:
                getMessage = await event.get_reply_message()
                get_id = getMessage.sender.id
                await event.edit(f"<a href ='tg://openmessage?user_id={get_id}'>{text}</a>", parse_mode = "HTML")
            except Exception as e:
                await bot.send_message('me', f"ＥＲＲＯＲ :\n\n{e}")

@bot.on(events.NewMessage(pattern=r'(hashtag|bold|italic|delete|code|underline|reverse|part|mention) (on|off)', outgoing=True))
async def editMode(event):
    if event.fwd_from:
        return
    match = event.raw_text.split(' ')
    js = get("data.json")
    js[match[0]] = str(match[1])
    put("data.json",js)
    mode = match[0].translate(match[0].maketrans("qwertyuiopasdfghjklzxcvbnm","ǫᴡᴇʀᴛʏᴜɪᴏᴘᴀsᴅғɢʜᴊᴋʟᴢxᴄᴠʙɴᴍ"))
    await event.edit(f"{mode} 𝗦𝘁𝗮𝘁𝘂𝘀: {match[1]}")

@bot.on(events.NewMessage(pattern=r'(typing|game|voice|video|sticker) (on|off)', outgoing=True))
async def editAction(event):
    if event.fwd_from:
        return
    match = event.raw_text.split(' ')
    js = get("data.json")
    js[match[0]] = str(match[1])
    put("data.json",js)
    action = match[0].translate(match[0].maketrans("qwertyuiopasdfghjklzxcvbnm","ǫᴡᴇʀᴛʏᴜɪᴏᴘᴀsᴅғɢʜᴊᴋʟᴢxᴄᴠʙɴᴍ"))
    await event.edit(f"{action} 𝗦𝘁𝗮𝘁𝘂𝘀: {match[1]}")

bot.start()
bot.parse_mode = 'markdown'
clock.start()
bot.run_until_disconnected()
asyncio.get_event_loop().run_forever()