SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Journal;
CREATE DATABASE Journal;

USE Journal;

CREATE TABLE Journal(
   id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-incrementing primary key
   patientId INT,                      -- Foreign key to reference the patient
   therapistId INT,                    -- Foreign key to reference the therapist (the patient's therapist)
   title VARCHAR(255),                 -- Title of the journal entry
   dateCreated DATE,                   -- Date the journal entry was created
   timeCreated TIME,                   -- Time the journal entry was created
   details TEXT,                       -- Detailed description of the journal entry
   moodLevel INT,                      -- Mood level, assuming it's a numerical scale
   file BLOB,                          -- Binary data such as file attachments (BLOB)
   FOREIGN KEY (patientId) REFERENCES Patient(id),   -- Foreign key relationship to Patient
   FOREIGN KEY (therapistId) REFERENCES Therapist(id) -- Foreign key relationship to Therapist
) AUTO_INCREMENT = 1;

-- Journal entries for Zoe--
-- Journal 1
INSERT INTO Journal (patientId, therapistId, title, dateCreated, timeCreated, details, moodLevel, file)
VALUES 
(1, 1, 'Productive day at work', '2024-09-24', '23:30:00', 
"I can hardly believe it—I actually did it. After six grueling months of constant stress, sleepless nights, and endless self-doubt, I finished the project. It was like climbing a mountain, and today, I finally reached the top. The client has been such a nightmare, always demanding more, never satisfied, and making me question every decision I made. But today, when I handed in that final report, and they actually smiled—really smiled—I felt a wave of relief and pride that I haven’t felt in a long time. <br> It’s like all the anxiety I’ve been carrying around suddenly lifted, even if just for a moment. I’ve been so hard on myself, convinced I wasn’t good enough, that I’d somehow mess this up, but I didn’t. I pushed through, despite all the times I wanted to give up, and now I can see that it was worth it. I’m excited, not just because it’s over, but because I proved to myself that I can handle this. I’m stronger than I thought. I still feel the anxiety lurking in the background, but today, it doesn’t seem as powerful. Today, I feel like I won, and that’s a feeling I want to hold onto for as long as I can.", 
10, NULL);

-- Journal 2
INSERT INTO Journal (patientId, therapistId, title, dateCreated, timeCreated, details, moodLevel, file)
VALUES 
(1, 1, 'Why me?', '2024-09-23', '22:45:00', 
"I don't know why I even bother anymore. Everything feels so heavy, like I'm carrying the weight of the world on my shoulders. Every day is the same—wake up, fight through the endless thoughts, pretend I'm okay, and then collapse back into bed, only to repeat the cycle. My heart races for no reason, my thoughts spiral out of control, and I can never seem to find a moment of peace. It's exhausting. I try to be strong, to keep going, but what's the point? I'm just so tired of constantly worrying about everything—about things that don't even matter in the grand scheme of things. But I can't stop. It's like I'm trapped in my own mind, suffocating under the pressure of my own thoughts. Everyone else seems to have it together, so why can't I? Why does everything feel like such a struggle? I hate that I can't control this, that it feels like I'll never be free of it. I just want to escape, to find some relief, but I don't even know what that would look like. How do I keep going when it all feels so pointless?",
3, NULL);

-- Journal 3
INSERT INTO Journal (patientId, therapistId, title, dateCreated, timeCreated, details, moodLevel, file)
VALUES 
(1, 1, 'Does my dog know how to talk?', '2024-09-22', '20:45:00', 
"Loneliness has become a constant companion, wrapping itself around me in ways I never imagined. Some days, the emptiness feels overwhelming, like there's no one in the world who truly understands. I see people with their friends, their families, and wonder why I can't feel that connection. It's like I'm on the outside looking in, always yearning for something I can't quite reach. But then there's Max, my sweet, loyal dog. He's the one being who seems to get me without needing any words. When the anxiety becomes too much, and I feel like I'm drowning in my own thoughts, Max is there, quietly lying next to me, offering a kind of comfort no human ever has. His soft fur under my hand, the way he looks at me with those big, trusting eyes—it's like he's saying, \"I'm here, you're not alone.\" I don't know what I'd do without him. He’s my anchor in this storm, reminding me that even in the depths of my loneliness, I’m not truly alone. I’m so grateful for him, for the unconditional love he gives me, for the way he’s always by my side, even when the world feels like it’s falling apart.",
4, NULL);

-- Journal 4
INSERT INTO Journal (patientId, therapistId, title, dateCreated, timeCreated, details, moodLevel, file)
VALUES 
(1, 1, 'Falling in love or is it just alcohol?', '2024-09-21', '19:00:00', 
"I don't usually let myself go like this, but tonight, after a few too many drinks, everything I’ve been holding back is bubbling to the surface. It’s strange how alcohol seems to peel away the layers I’ve carefully built around myself, exposing this raw, aching need for connection. I can’t help but think about how lonely I am, how much I crave the touch, the warmth of another person. I’ve always been so scared to let anyone in, terrified they’ll see the mess I am inside, but right now, all I want is someone to hold me, to tell me it’s going to be okay. It’s like there’s a hole inside me, and no matter how much I try to fill it with distractions or pretend it’s not there, it never goes away. I want to be loved, to be seen, to be someone’s person, but I’m so afraid. I don’t know how to let go of this fear, this anxiety that keeps me trapped in my own mind. The alcohol makes it easier to imagine what it would be like, to dream of a world where I’m not so alone, but I know when I wake up, I’ll be back in my cage, longing for something I’m too scared to reach for.",
6, NULL);