
-- users
ALTER TABLE public.users ADD COLUMN limitmonth integer DEFAULT 0;
ALTER TABLE public.users ADD COLUMN limitmonth double precision DEFAULT 0.0;

ALTER TABLE IF EXISTS public.ip_printers ADD COLUMN IF NOT EXISTS tipo integer DEFAULT 0;
update ip_printers set tipo=1;
ALTER TABLE IF EXISTS public.ip_printers ADD COLUMN IF NOT EXISTS status integer DEFAULT 0;
update ip_printers set status=0;
update ip_printers set status=1 where ip_printers.id_printer>=35;